    function openTab(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "flex";
        evt.currentTarget.className += " active";
        var x = evt.currentTarget.classList;
        for (i = 0; i < x.length; i++) {
            if (x[i] == "tablinks") {
                x[i].firstChild;
            }
        }
    }

    $(document).ready(function() {
        var b = document.getElementById('non-personal');
        var tabarray = document.getElementsByClassName('tablinks');
        var initialTab = tabarray[0];
        initialTab.classList.toggle('active');
        b.style.display = 'none';
    });