<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Ticket</title>
    <style>
        .hero { 
            position: relative; 
            height: 100vh;
            width: 100%;
            display: grid;
            align-items: center;
            justify-content: center;
            background-image: url('{{ asset('storage/uploads/5pKrlGIfxqA3uzkKYZOCb20RcfBE3Ul3c9HhSvRB.jpg') }}');
            background-size: contain;
            background-repeat:no-repeat;
        }

        .hero::before {
            content: "";
            position: absolute;
            top: 0px;
            right: 0px;
            bottom: 0px;
            left: 0px;
            background-color: rgba(255, 252, 252, 0.608);
        }
        h1 {
            padding-bottom: 10px;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
        }
        p {
            font-family:'Courier New', Courier, monospace;
        }
    </style>
  </head>
  <body >
    {{-- <div class="hero">
        <h1>Ticket</h1>
       <img style="position: relative" src="{{ asset('storage/uploads/4wVAH.png') }}" alt="">
    </div> --}}
    <div class="card d-flex justify-content-center">
        <img src="{{ asset('storage/' . $data['event_image']) }}" class="card-img-top" alt="">
        <div class="card-body d-grid justify-content-center">
          <h1 class="card-title d-grid justify-content-center"><strong>{{ $data['name_ticket'] }}</strong></h1>
          <img src="{{ asset('storage/' . $data['qr']) }}" alt="">
        </div>
        <div class="card-footer d-grid justify-content-center">
            <p>Visit our website <strong>{{ $data['website'] }}</strong></p>
        </div>
      </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
