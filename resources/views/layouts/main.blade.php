<main id="main-content">
    <div id="viewlet-above-content">
    </div>
    <div class="">
        <dl class="portalMessage info" id="kssPortalMessage" style="display:none">
            <dt>Info</dt>
            <dd></dd>
        </dl>
        @yield('content')
    </div>
    <div id="viewlet-below-content">
        <div class="social-links">
            @auth
                <span omit-tag=""> Usuário: {{ auth()->user()->name }}</span> </br>
            @endauth   
                <span omit-tag=""> (Versão {{ config('app.versao') }})</span>           
           
        </div>

    </div>
</main>