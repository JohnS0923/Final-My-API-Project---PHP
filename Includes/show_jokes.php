<div class="jokes">
    <h2>List of Jokes</h2>
    <div id="list">List</div> 
</div>
<script>
    // Assign the PHP variable value to a JavaScript variable
    var apiKey = '<?php echo $_SESSION['apikey']; ?>';

    // Function to fetch stock data and update the DOM
    function getApiData() {
        // make a api call with the key
        axios.get('Model/api.php?key=' + apiKey+'&option=getall')
            .then(function (response) {
                const res = response.data;
                // check to see if key is right
                if(res != false){
                    let html = '<ul>';
                    res.forEach(joke => {
                    // make a li to show joke
                    html += `<li>${joke.Setup} : ${joke.Punchline}   `;
                    // add an edit link 
                    html += `<a class="link" href="./?option=edit&id=${joke.JokeID}">Edit</a> | `;
                    // add a delete link and close li
                    html += `<a class="link" href="./?option=delete&id=${joke.JokeID}">Delete</a></li>`;
                    });
                    html += '</ul>';
                    document.getElementById('list').innerHTML = html;
                }
                // else if keey failed set innerhtml to a link to renter key
                else{
                    document.getElementById('list').innerHTML = '<a class="link" href="./?option=enterapi">Re-Enter Key</a>';

                }
                
            })
            .catch(function (error) {
                console.log("Error fetching API data:", error);
            });
    }

    // Call the function on page load
    getApiData();
</script>

