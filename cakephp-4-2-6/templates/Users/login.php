<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
		<?php echo $this->element('form_info'); ?>
        <!-- BEGIN: Login Form -->
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-dark-1 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Zaloguj
                </h2>
                <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">Otrzymuj powiadomienia na adres email o wynikach w Lotto, Lotto Plus, Mini Lotto.</div>
                <?php
            	   echo $this->Form->create($form);
        	    ?>
                <div class="intro-x mt-8">
					<?php
            	       echo $this->Form->control("email", array(
            	           "placeholder" => "Email",
            	           "label" => false,
            	           "class" => "intro-x login__input form-control py-3 px-4 border-gray-300 block",
            	       ));
            	       echo $this->Form->control("password", array(
            	           "type" => "password",
            	           "placeholder" => "Hasło",
            	           "label" => false,
            	           "class" => "intro-x login__input form-control py-3 px-4 border-gray-300 block mt-4",
            	       ));
					?>
                </div>
                <div class="intro-x flex text-gray-700 dark:text-gray-600 text-xs sm:text-sm mt-4">
                	<a href="/users/reset">Zapomniałeś hasła?</a> 
                </div>
                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                	<?php
                        echo $this->Form->button("Zaloguj", array(
                            "class" => "btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top"
                        ));
                        echo $this->Html->link("Zarejestruj",
                            array("controller" => "users", "action" => "register"),
                            array( "class" => "btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top"));
                        echo $this->Form->end();
                	?>
                </div>
            </div>
        </div>
        <!-- END: Login Form -->
    </div>
</div>