<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"rel="stylesheet"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"rel="stylesheet"/>
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css"rel="stylesheet"/><style>

.gradient-custom-2 {
    background:rgb(70, 70, 70);
    background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
    }

@media (min-width: 768px) {
    .gradient-form {
    height: 100vh !important;
    }
}
@media (min-width: 769px) {
    .gradient-custom-2 {
    border-top-right-radius: .3rem;
    border-bottom-right-radius: .3rem;
    }
}

</style>

<section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp"
                    style="width: 185px;" alt="logo">
                  <h4 class="mt-1 mb-5 pb-1">We are Jago Joki Team</h4>
                </div>

                <form method="POST" action="{{ route('admin.login.submit') }}">
                  @csrf
                  <p>Please login to your account</p>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="form2Example11" name="email" class="form-control" placeholder="Email address" value="{{ old('email') }}" required autofocus />
                    <label class="form-label" for="form2Example11">Email</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required />
                    <label class="form-label" for="form2Example22">Password</label>
                  </div>

                  <div class="text-center pt-1 mb-5 pb-1">
                    <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Login</button>
                  </div>
                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">We Are Jago Joki Team</h4>
                <p class="small mb-0">We Are Jago Joki adalah tim profesional yang berfokus pada layanan joki game terpercaya dan berpengalaman. Kami mengutamakan keamanan akun, kecepatan pengerjaan, dan hasil yang memuaskan. Dikerjakan oleh pemain berpengalaman di bidangnya, kami siap membantu kamu mencapai rank impian tanpa repot!</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"
></script>