<!DOCTYPE html>
<html>
    <head>
        <title> Time Range Query</title>
    </head>
    <body>
        <form action="timerange.php" method="POST">
            <div>
                <h1>Enter the time range:<h1>
                <br>
                    <label for="start">Start Date</label>
                    <input id="start" name="start" type="datetime-local">

                    <label for="end">End Date</label>
                    <input id="end" name="end" type="datetime-local">
            </div>
            <div>
                <input id="execute-search-button" type="submit" value="Execute Time Range Search">
            </div>
        </form>
    </body>
</html>
