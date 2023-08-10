

<!-- Vendor JS Files -->
<script src="{{ asset("assets/vendor/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/vendor/quill/quill.min.js") }}"></script>
<script src="{{ asset("assets/vendor/php-email-form/validate.js") }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset("assets/js/main.js") }}"></script>

@yield('custom_js')

<script>

    function deleteItem(link) {
        var answer = prompt("Are you sure? Type 'yes' to perform the operation!");
        if (answer === "yes") {
            //console.log('you said yes')
            window.location.href = link;
        }else{
            console.log('action ignored')
        }
    }

    </script>
