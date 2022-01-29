<?php
/** @var $this \app\core\View */

use app\core\Application;

require_once Application::$ROOT_DIR . '/scripts/statistics.php';
$this->title = 'Home page';
?>
<div class="main_content" style="width: 70%;">
<?php if (Application::isGuest()): ?>
    <div class="Content">
        <h1>Welcome in</h1> 
        <img src="/css/logoblack.svg" style="width: 500px;">
        <h2 color="#2C2C34">Time tracking for <em>better</em> work, not overwork.</h2>
    </div>
	
	<div class="Content">
		<h2 color="#2C2C34" style="margin: 5px">Statistics</h2><br>
		
		<h3 color="#2C2C34" style="margin: 5px"> How many users are working with us? </h3>
		<h3 color="#2C2C34" style="margin: 5px"> <em><?php echo statistics("users"); ?></em> </h3><br>
		
		<h3 color="#2C2C34" style="margin: 5px"> How much time did users spend on their projects? </h3><br>
		<h3 color="#2C2C34" style="margin: 5px"> This week </h3>
		<h3 color="#2C2C34" style="margin: 5px"> <?php echo statistics("week"); ?> </h3><br>

		<h3 color="#2C2C34" style="margin: 5px"> This month </h3>
		<h3 color="#2C2C34" style="margin: 5px"> <?php echo statistics("month"); ?> </h3><br>
		
		<h3 color="#2C2C34" style="margin: 5px"> This year </h3>
		<h3 color="#2C2C34" style="margin: 5px"> <?php echo statistics("year"); ?> </h3><br>
		
		<h3 color="#2C2C34" style="margin: 5px"> From the beginning of our site </h3>
		<h3 color="#2C2C34" style="margin: 5px"> <?php echo statistics("beginning"); ?> </h3><br>
    </div>

<?php else: ?>
    <div class="Content">
        <h1><?php echo Application::$app->user->getDisplayFirstName() ?> welcome in</h1>
        <img src="/css/logoblack.svg" style="width: 500px;">
        <h2 color="#2C2C34">Time tracking for <em>better</em> work, not overwork.</h2>
    </div>
<?php endif; ?>


    <div class="Content">
        <h2 color="#2C2C34">Time Is Money.<br>Clocker. Saves You <em>Both</em></h2>
        <p color="#2C2C34" style="margin-left: auto; margin-right: auto; width: 70%;">Whether you're a team of one or a team of one thousand, <br> Clocker. is all about saving you time and money — and from anxiety</p>
    </div>

    <div class="Content">
    <h2 color="#2C2C34" style="margin: 20px"> Why Clocker.?</h2>
    <div class="WhyTrackIconWrapper">
        <div class="Root">
            <img src="/css/1.png" style="width: 60px;">
            <div class="Text right">
                <h4 class="Title">Low barrier to entry</h4>
                <p class="Paragraph">Intuitive time tracking to get you and your team onboard without a hitch</p>
            </div>
            <div class="Text center">
            </div>
            <img src="/css/2.png">
            <div class="Text left">
                <h4 class="Title">Insightful reporting</h4>
                <p class="Paragraph">Data from all projects and users are aggregated into a single dashboard</p>
            </div>
        </div>
        <div class="Root">
            <img src="/css/3.png">
            <div class="Text right">
                <h4 class="Title">Works where you work</h4>
                <p class="Paragraph">Track your time via our web, desktop or mobile apps, or inside your favorite apps (100+ integrations)</p>
            </div>
            <div class="Text center">
            </div>
            <img src="/css/4.png" >
            <div class="Text left">
                <h4 class="Title">Tracking reminders</h4>
                <p class="Paragraph">Outsource the nagging to us with tracking reminders and required fields</p>
            </div>
        </div>
        <div class="Root">
            <img src="/css/5.png">
            <div class="Text right">
                <h4 class="Title">Security-savvy</h4>
                <p class="Paragraph">We stay compliant with the latest regulatory developments</p>
            </div>
            <div class="Text center">
            </div>
            <img src="/css/6.png">
            <div class="Text left">
                <h4 class="Title">Stellar support</h4>
                <p class="Paragraph">Our support team has a track record of getting back to you within 3 hours!</p>
            </div>
        </div>
    </div>

</div>
