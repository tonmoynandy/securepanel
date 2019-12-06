var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function () {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
        } else {
            dropdownContent.style.display = "block";
        }
    });
}

$(() => {
    $('[data-toggle="tooltip"]').tooltip()
    $("#toggleSidebarSpan").on('click', function () {

        $(".sidenav").toggleClass('open');
        $(".sidenav").toggleClass('close');
    })

    if ($(".flash-header-alert").length > 0) {
        setTimeout(() => {
            $(".flash-header-alert").hide();
        }, 3000);
    }


});

function sweetalertMessageRender(target, message, type, confirm = false) {

    let options = {
        title: '',
        text: message,
        type: type
    };
    if (confirm) {
        options['showCancelButton'] = true;
        options['confirmButtonText'] = 'Yes';
    }

    return Swal.fire(options)
    .then((result) => {
        if (confirm == true && result.value) {
            window.location.href = target.getAttribute('data-href'); 
        } else {
            return (false);
        }
    });

}
var table = document.querySelector('.table');
if (table) {

    if (window.screen.width >= 320 && window.screen.width <= 1024) {
        let wrapperThead = document.createElement('div');
        wrapperThead.classList.add('thead');
        var tableElement = document.querySelector('div.thead-tr');
        tableElement.parentNode.insertBefore(wrapperThead, tableElement);
        wrapperThead.appendChild(tableElement);

        let wrapperTBody = document.createElement('div');
        wrapperTBody.classList.add('tbody');
        var tableBodyElement = document.querySelectorAll('div.tbody-tr');

        tableBodyElement.forEach((item) => {

            wrapperTBody.appendChild(item);
        });
        wrapperThead.parentNode.appendChild(wrapperTBody);

    } else {
        let thead = document.querySelector('div.thead')
        if (thead) {
            let theadHtml = thead.innerHTML;
            thead.parentNode.append = tbodyHtml;
            thead.parentNode.removeChild(thead);
        }


        let tbody = document.querySelector('div.tbody')
        if (tbody) {
            let tbodyHtml = tbody.innerHTML;
            tbody.parentNode.append = tbodyHtml;
            tbody.parentNode.removeChild(tbody);
        }


    }
}
