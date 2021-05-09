<?php

use Cake\Core\Configure;

?>
<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="/" class="-intro-x flex items-center pt-5">
                    <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="/dist/images/logo.svg">
                    <span class="text-white text-lg ml-3"><?= Configure::read('Config.WebName') ?></span>
                </a>
                <div class="my-auto">
                    <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="/dist/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Otrzymuj powiadomienia
                        <br>
                        na adres e-mail
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500">o wynikach w Lotto, Lotto Plus, Mini Lotto.</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Zaloguj się
                    </h2>
                    <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Otrzymuj powiadomienia na adres e-mail o wynikach w Lotto, Lotto Plus, Mini Lotto.</div>
                    <?php
                	   echo $this->Form->create($form);
            	    ?>
                    <div class="intro-x mt-8">
                       <?php
                	       echo $this->Form->control("email", array(
                	           "placeholder" => "E-mail",
                	           "label" => false,
                	           "class" => "intro-x login__input form-control py-3 px-4 border-gray-300 block"
                	       ));
                	       echo $this->Form->control("password", array(
                	           "type" => "password",
                	           "class" => "intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4",
                	           "placeholder" => "Hasło",
                	           "label" => false,
                	       ));
                	   ?>
                    </div>
                    <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                        <a href="/">Zapomniałeś hasła?</a> 
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                         <?php
                            echo $this->Form->button("Zaloguj", array(
                                "class" => "btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                            ));
                    	 ?>
                         <?php 
                            echo $this->Html->link("Zarejestruj", array(
                                "controller" => "users", 
                                "action" => "register"
                            ), 
                            array('class' => "btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"));
                         ?>
                    </div>
                    <?php
                	  echo $this->Form->end();
                	?>
                </div>
            </div>
            <!-- END: Login Form -->
        </div>
    </div>
    <!-- BEGIN: JS Assets-->
    <script src="/dist/js/app.js"></script>
    <!-- END: JS Assets-->
</body>
