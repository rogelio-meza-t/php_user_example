<?php if( currentUser() ): ?>
    <?php if (Flash::exists("success")): ?>
        <div>
            <?= Flash::show("success"); ?>
        </div>
    <?php endif; ?>
    <div>You are currently logged in</div>
<?php else : ?>
    <form action="/sign_in" method="post">
        <input name="username" type="text" placeholder="Username"/>
        <input name="password" type="password" placeholder="Password"/>
        <input name="login" type="submit">
    </form>
<?php endif; ?>
