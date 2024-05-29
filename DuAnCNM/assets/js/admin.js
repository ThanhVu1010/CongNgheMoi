


/* =========== DASHBOARD TOGGLE ORDERS TABS ======== */

function openTab(evt, tabName, tabContent, tabLinks) 
{
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName(tabContent);

    for (i = 0; i < tabcontent.length; i++) 
    {
        tabcontent[i].style.display = "none";
    }
    
    tablinks = document.getElementsByClassName(tabLinks);

    for (i = 0; i < tablinks.length; i++) 
    {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  
    document.getElementById(tabName).style.display = "table";
    evt.currentTarget.className += " active";
}