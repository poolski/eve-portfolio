    <div id="login_form">
        <form action="<?php echo base_url();?>login/process" method="post" name="process">
            <input placeholder="Your username" type="text" name='username' id='username'/><br />
            <input placeholder="Your password" type="password" name="password" id='password'/><br />
            <button type="Submit" value="Login">Login</button>
        </form>
    </div>