<html>
<head>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.bundle.min.js" integrity="sha384-zDnhMsjVZfS3hiP7oCBRmfjkQC4fzxVxFhBx8Hkz2aZX8gEvA/jsP3eXRCvzTofP" crossorigin="anonymous"></script>
</head>
<body>
  <div class="wrapper">

    <section class="content">
      <div class="row">
        <div class="col-md-12 text-center">
          <div class="col-md-6"><img src="{{ asset('/dist/img/inventory-icon.png') }}" style=" width: 100px; height: 100px; " class="img pull-right"></div><div class="col-md-6">e - INVENTORY</div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          {{ $data->content }}
        </div>
      </div>
    </section>
  </div>
</body>
</html>
