<form action="login" method="POST" class="container-login">

    <!-- <a href="home" id="logo"><img src="" alt="Logo" /></a>  -->

    <section>
        <h3>LOGIN</h3>
    </section>

    <section>
        <p>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="input"/>  
        </p>

        <p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="input"/>    
        </p>
    </section>

    <section>
        <button type="submit" class="btn btn-form-login" onclick="reloadPage()">LOG IN</button>
    </section>
</form>