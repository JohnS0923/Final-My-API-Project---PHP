
<h2>Your Key</h2>
<p id='key'></p>

<script>
    // Assign the PHP variable value to a JavaScript variable
    var email = '<?php echo $_GET['email']; ?>';

    // Function to make api key from email
    function getApiData() {
        axios.get('Model/api.php?email=' + email)
            .then(function (response) {
                const res = response.data;
                document.getElementById('key').innerHTML = res;
            })
            .catch(function (error) {
                console.log("Error fetching API data:", error);
            });
    }

    // Call the function on page load
    getApiData();
</script>