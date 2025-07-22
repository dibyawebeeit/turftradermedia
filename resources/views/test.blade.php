<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Google Translate Custom Dropdown</title>
</head>
<body>

<div class="container">
  <h1>Welcome to My Laravel App</h1>
  <p>This is some content that will be translated.</p>
  <p>You can add all your page content here.</p>

  <h2>Custom Language Switch</h2>

  <!-- add this to your header -->
  <div id="google_translate_element"></div> 
 
  <!-- to your js part -->
  <script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
            {pageLanguage: 'en'},
            'google_translate_element'
        );
    } 
  </script>
  <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</div>

</body>
</html>
