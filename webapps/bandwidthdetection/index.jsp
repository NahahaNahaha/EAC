<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dummy Bandwidth Detection</title>
  </head>
  <body>
    <form class="form" action="javascript:" method="post">
      <div class="form--seconds">
        <label for="form--seconds-input">Bandwidth Check Seconds:</label>
        <input type="number" name="form--seconds-input" class="form--seconds-input" value="3">
      </div>
      <div class="form--timeout">
        <label for="form--timeout-input">Timeout Seconds:</label>
        <input type="number" name="form--timeout-input" class="form--timeout-input" value="1">
      </div>
      <div class="form--submit">
        <button type="submit" name="form--submit-btn">Check Bandwidth</button>
      </div>
    </form>

    <div class="results">
      Waiting for results...
    </div>

    <script src="index.js" charset="utf-8"></script>
  </body>
</html>
