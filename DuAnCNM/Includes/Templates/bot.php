<style>
/* General Styles for Chat Container */
.chat-container {
    position: fixed;
    bottom: 0;
    right: 35px;
    width: 350px;
    height: 500px;
    background-color: #f7f7f7;
    border-radius: 10px 10px 0 0;
    border: 1px solid #ccc;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    z-index: 1000;
}


/* Header of the Chat Box */
.modal-header {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 50px;
    background-color: #0396FF;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 15px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;

}

/* Close Button Styling */
.close-chat {
    position: absolute;
    top: 10px;
    right: 10px;
    border: none;
    background: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    z-index: 1100;
}


/* Messenger Icon Style */
.messenger-icon {
    display: inline-block;
    width: 65px;
    height: 65px;
    font-size: 30px;
    text-align: center;
    line-height: 60px;
    background-color: #0396FF;
    color: #fff;
    border-radius: 50%;
    position: fixed;
    bottom: 130px;
    right: 35px;
    text-decoration: none;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, transform 0.3s;
}

/* Hover Effect for Messenger Icon */
.messenger-icon:hover {
    background-color: #0056b3;
    transform: scale(1.1);
}

/* Modal Content Styling */
.modal-content {
    background-color: #f7f7f7;
    border-radius: 10px;
}

/* Modal Body Styling */
.modal-body {
    padding: 0;
    display: flex;
    flex-direction: column;
    height: 100%;

}

/* Message Styling */
.inbox {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 10px;
}

/* Bot Message Styling */
.bot-inbox {
    color: #444;
    background-color: #e7f5ff;
    border-radius: 20px;
    margin-right: auto;
}

/* User Message Styling */
.user-inbox {
    background-color: #dcf8c6;
    border-radius: 20px;
    margin-left: auto;
}

/* Text Styling for Messages */
.msg-header p {
    margin: 0;
    padding: 8px 15px;
    font-size: 14px;
    word-wrap: break-word;
}

/* Message Form Styling */
.form {
    position: absolute;
    top: 50px;

    bottom: 50px;

    left: 0;
    right: 0;
    overflow-y: auto;
    padding: 10px;
}

/* Typing Field Styling */

.typing-field {
    position: absolute;
    left: 0;
    right: 0;
    bottom: 0;
    height: 50px;
    /* Adjust as needed */
    display: flex;
    padding: 10px;
    background-color: #fff;
    border-top: 1px solid #eee;
}

.input-data {
    flex: 1;
    display: flex;
}

.input-data input {
    flex-grow: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.input-data button {
    background-color: #0396FF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.input-data button:hover {
    background-color: #0056b3;
}

.chatbot-icon {
    width: 40px;
    height: auto;
    margin-right: 10px;
}

.chatbot-icon-container {
    display: flex;
    align-items: center;
}

.close-chat {
    background: none;
    border: none;
    font-size: 1.5em;
    cursor: pointer;
}
</style>
<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
<!-- Messenger Icon to open chat -->
<li><a href="#" class="messenger-icon"><img src="/DuAnCNM/assets/image/chatbot_icon.png" alt="chatbot" class="chatbot-icon"></i></a></li>

<!-- Floating Chat Box -->
<div class="chat-container" style="display: none;">
    <div class="modal-header">
        <div class="chatbot-icon-container">
            <img src="/DuAnCNM/assets/image/chatbot_icon.png" alt="chatbot" class="chatbot-icon">
            <h5 class="modal-title" id="chatbotModalLabel">DreamSpark ChatBot</h5>
        </div>
        <button type="button" class="close-chat">×</button>
    </div>
    <div class="modal-body">
        <div class="form">
            <div class="bot-inbox inbox">
                <div class="icon">
                    <img src="/DuAnCNM/assets/image/chatbot_icon.png" alt="chatbot" class="chatbot-icon">
                </div>
                <div class="msg-header">
                    <p>Chào bạn, Tui có thể giúp gì cho bạn?</p>
                </div>
            </div>
            <div class="bot-inbox inbox">
                <div class="icon">
                    <img src="/DuAnCNM/assets/image/chatbot_icon.png" alt="chatbot" class="chatbot-icon">
                </div>
                <div class="msg-header">
                    <p>Nếu bạn muốn được gợi ý các ngành học thì hãy nhập vào "Gợi ý ngành học"</p>
                </div>
            </div>
        </div>
        <div class="typing-field">
            <div class="input-data">
                <input id="data" type="text" placeholder="Type something here.." required>
                <button id="send-btn">Send</button>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<script>
$(document).ready(function() {
    $(".messenger-icon").on("click", function() {
        $(".chat-container").toggle();
    });

    $(".close-chat").on("click", function() {
        $(".chat-container").hide();
    });

    $("#send-btn").on("click", sendMessage);
    $("#data").keypress(function(e) {
        if (e.which == 13) { // Enter key
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        var value = $("#data").val();
        if (value.trim() == "") return; // Prevent sending empty messages
        var msg = '<div class="user-inbox inbox"><div class="msg-header"><p>' + value + '</p></div></div>';
        $(".form").append(msg);
        $("#data").val('');

        $.ajax({
            url: '/DuAnCNM/chatbot/chatbot/message.php',
            type: 'POST',
            data: {
                text: value
            },
            dataType: 'json',
            success: function(result) {
                console.log(result); // Debugging: log the response
                if (result.error) {
                    alert(result.error);
                    window.location.href = 'index.php?mod=login'; // Redirect to login page
                    return;
                }

                if (result.message) { // Check if message key exists
                    var reply =
                        '<div class="bot-inbox inbox"><div class="icon"><img src="/DuAnCNM/assets/image/chatbot_icon.png" alt="chatbot" class="chatbot-icon"></div><div class="msg-header"><p>' +
                        result.message + '</p></div></div>';
                    $(".form").append(reply);
                    $(".form").scrollTop($(".form")[0].scrollHeight);
                } else {
                    console.error("Unexpected result structure:", result);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    }
});
</script>