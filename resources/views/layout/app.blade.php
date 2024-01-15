  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>Document</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <style>
          * {
              margin: 0;
              padding: 0;
              box-sizing: border-box;
          }

          nav {
              width: 100vw;
              height: max-content;
              display: flex;
            justify-content: space-around;
          }

          ul {
              font-size: 30px;
              padding: 10px;
              display: flex;
              justify-content: center;
              align-items: center;
              list-style-type: none;
              text-align: center;
          }

          ul li {
              width: max-content;
              text-align: center;

          }

          ul li a {
              text-decoration: none;
              color: blue;
              padding-right: 20px;
              font-size: 20px;
              text-align: center;
          }

          ul li a:hover {
              background-color: cyan;
              border-radius: 10px;
          }

          footer {
              bottom: 0;
              width: 100vw;
              background-color: rgb(183, 181, 181);
              padding: 15px;

          }

          .acc{
            display: flex;
            align-items: center;
          }
      </style>
  </head>

  <body>
      <nav>
          <ul>
              <li><a href="/home">Home</a></li>
              <li><a href="/data-barang">Info Barang</a></li>
              <li><a href="/tambah-barang">Tambah Barang</a></li>
              <li><a href="/logout">Logout</a></li>
          </ul>
          <div class="acc">
              <p>Selamat Datang {{ $name }}</p>
              <img src="{{ $avatar }}" class="img-thumbnail" alt="...">
          </div>
      </nav>
      @yield('content')
      <br>
      <footer>
          <p>Tugas Akhir Aldi CS</p>
      </footer>
  </body>
  <script>
      const msg = '{{ Session::get('status') }}';
      const exist = '{{ Session::has('status') }}';
      if (exist) {
          alert(msg);
      }
  </script>

  </html>
