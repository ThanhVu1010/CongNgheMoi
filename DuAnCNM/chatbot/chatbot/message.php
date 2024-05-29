<?php
header('Content-Type: application/json; charset=utf-8');

session_start();

include_once(__DIR__ . "/../../Model/ketnoi.php");

// Connecting to database securely
$db = new KetNoiDB();
$con = $db->moKetNoi();

if (!$con) {
    error_log("Failed to connect to database: " . $con->connect_error);
    echo json_encode(['error' => 'Internal server error']);
    exit;
}

$getMesg = mysqli_real_escape_string($con, $_POST['text'] ?? '');

if (empty($getMesg)) {
    echo json_encode(['error' => 'No message received']);
    exit;
}

function preprocessInput($input) {
    $input = strtolower($input);
    $input = preg_replace('/[^\w\s]/', '', $input);
    $tokens = explode(' ', $input);
    return $tokens;
}

function processUserRequest($message, $con) {
    // First, check if there's a direct match in the database
    if (checkDirectDatabaseMatch($message, $con)) {
        return;
    }

    // If not, process as a generic suggestion query
    if (preg_match('/(gợi ý|chọn|ngành học|tư vấn ngành)/i', $message)) {
        if (!isset($_SESSION['asking_for_majors'])) {
            $_SESSION['asking_for_majors'] = true;
            echo json_encode(['message' => 'Hãy nói cho tui biết sở thích hoặc kỹ năng hoặc một môn học mà bạn yêu thích.']);
            return;
        } else {
            searchForMajors($message, $con);
            return;
        }
    }

    if (!empty($_SESSION['asking_for_majors'])) {
        searchForMajors($message, $con);
    } else {
        searchInGeneralResponses($message, $con);
    }
}

function checkDirectDatabaseMatch($message, $con) {
    $query = "SELECT Cautraloi FROM chatbot WHERE Cauhoi = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $message);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $fetch_data = mysqli_fetch_assoc($result);
            echo json_encode(['message' => $fetch_data['Cautraloi']]);
            mysqli_stmt_close($stmt);
            return true;
        }
        mysqli_stmt_close($stmt);
    }
    return false;
}

function searchForMajors($criteria, $con) {
    $criteria = strtolower($criteria);
    $keywords = explode(',', $criteria);

    $query = "SELECT m.tennganhhoc, m.Mota
              FROM nganhhoc m 
              JOIN tieuchuan c ON m.Idnganhhoc = c.Idnganhhoc 
              WHERE";

    $params = [];
    $conditions = [];
    foreach ($keywords as $keyword) {
        $keyword = trim($keyword);
        $conditions[] = " LOWER(c.sothich) LIKE CONCAT('%', ?, '%')";
        $params[] = $keyword;
    }

    $query .= implode(' OR ', $conditions);
    $query .= " LIMIT 5";

    if ($stmt = mysqli_prepare($con, $query)) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $response = "Dựa trên sở thích của bạn là: $criteria, tui đề xuất các ngành sau:";
            while ($row = mysqli_fetch_assoc($result)) {
                $response .= "<br/>Tên ngành: " . htmlspecialchars($row['tennganhhoc']);
                $response .= "<br/>Mô tả: " . htmlspecialchars($row['Mota']);
                $response .= "<br/>---------------------------";
            }
            unset($_SESSION['asking_for_majors']);
            echo json_encode(['message' => $response]);
        } else {
            unset($_SESSION['asking_for_majors']);
            echo json_encode(['message' => 'Không tìm thấy ngành nào phù hợp với sở thích của bạn.']);
        }
        mysqli_stmt_close($stmt);
        return;
    } else {
        error_log("Query preparation failed: " . mysqli_error($con));
        echo json_encode(['error' => 'Có lỗi xảy ra khi chuẩn bị truy vấn.']);
    }
}

function searchInGeneralResponses($message, $con) {
    $query = "SELECT Cautraloi FROM chatbot WHERE Cauhoi LIKE CONCAT('%', ?, '%')";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "s", $message);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $fetch_data = mysqli_fetch_assoc($result);
            echo json_encode(['message' => $fetch_data['Cautraloi']]);
        } else {
            echo json_encode(['message' => "Xin lỗi, tui không hiểu ý của bạn là gì khi nói '$message'."]);
        }
        mysqli_stmt_close($stmt);
    } else {
        error_log("General response query preparation failed: " . mysqli_error($con));
        echo json_encode(['error' => 'Có lỗi xảy ra khi chuẩn bị truy vấn.']);
    }
}

processUserRequest($getMesg, $con);
?>
