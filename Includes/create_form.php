<h1 class="title">Add Joke</h1>

<form action="" method='get'>
  <div class="mb-3">
    <label for="setup" class="form-label">Setup</label>
    <input type="text" class="form-control" id="setup" name='setup' require>
  </div>
  <div class="mb-3">
    <label for="punchline" class="form-label">Punchline</label>
    <input type="text" class="form-control" id="punchline" name='punchline' require>
  </div>
  <input type="hidden" name="option" value="addjoke">

  <input type="submit" class="btn btn-primary" value="Submit">
</form>