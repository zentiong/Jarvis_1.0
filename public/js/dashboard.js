    function openTab(evt, cityName) {
        // Declare all variables
        let i, tabcontent, tablinks;

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
        let x = evt.currentTarget.classList;
        for (i = 0; i < x.length; i++) {
            if (x[i] == "tablinks") {
                x[i].firstChild;
            }
        }
    }

    $(document).ready(function() {
        let b = document.getElementById('non-personal');
        let c = document.getElementById('department-wide');
        let tabarray = document.getElementsByClassName('tablinks');
        let initialTab = tabarray[0];
        initialTab.classList.toggle('active');
        b.style.display = 'none';
        c.style.display = 'none';
    });