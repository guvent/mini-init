
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">My Framework</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">Ana Sayfa <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menü</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/menu/keys">Keyler</a>
                    <a class="dropdown-item disabled" href="#">
                        <hr></a>
                    <a class="dropdown-item" href="/menu/userprofile">Kullanıcı </a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a href="/logout" class="nav-link active">Çıkış Yap</a>
        </form>
    </div>
</nav>