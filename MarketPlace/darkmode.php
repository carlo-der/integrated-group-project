<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="darkmode.css" rel="stylesheet">

</head>
<body>

<h2>Toggle Dark/Light Mode</h2>
<p>Click the button to toggle between dark and light mode for this page.</p>

<button onclick="Darkmode()">Toggle dark mode</button>

<script>
function Darkmode() {
   var element = document.body;
   element.setAttribute('data-theme', element.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
}
</script>

</body>
</html>


