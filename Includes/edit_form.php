

<h1 class="title">Edit Joke</h1>

<form action="" method='get'>
  <div class="mb-3">
    <label for="setup" class="form-label">Setup</label>
    <input type="text" class="form-control" id="setup" name='setup' require>
  </div>
  <div class="mb-3">
    <label for="punchline" class="form-label">Punchline</label>
    <input type="text" class="form-control" id="punchline" name='punchline' require>
  </div>
  <input type="hidden" name="option" value="editinfo">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

  <input type="submit" class="btn btn-primary" value="Submit">
</form>

<script>
    // Assign the PHP variable value to a JavaScript variable
    var apiKey = '<?php echo $_SESSION['apikey']; ?>';
    var id = '<?php echo $_GET['id']; ?>';
    // Function to fetch stock data and update the DOM
    function getApiData() {
        // make a api call with the key and option of getone and pass the id
        axios.get('Model/api.php?key=' + apiKey+'&option=getone&id='+id)
            .then(function (response) {
                const res = response.data;
                // set setup value
                document.getElementById('setup').value = res.Setup;
                // set punchline value
                document.getElementById('punchline').value = res.Punchline;

            })
            .catch(function (error) {
                console.log("Error fetching API data:", error);
            });
    }

    // Call the function on page load
    getApiData();
</script>