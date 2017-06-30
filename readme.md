<h2>laravel-chat-app</h2>
<p>
	A realtime chat app built with Laravel 5.4, vue.js and pusher. We can send both text messages and files (e.g images,pdf,zip etc) through this app.
</p>
<p align="center"><img src="http://res.cloudinary.com/dxwpi6npb/image/upload/v1498798759/chat-app_y1iqpj.png"></p>
<p><g-emoji alias="speech_balloon" fallback-src="https://assets-cdn.github.com/images/icons/emoji/unicode/1f4ac.png" ios-version="6.0">💬</g-emoji> <a href="http://consultpronp.com/chat/public/register">Live Demo</a></p>
<h3>Project Installation</h3>
<ol>
<li>Clone repo / download project.</li>
<li>Open cmd and go to your project directory folder.</li>
<li>Install composer dependencies <code>composer install</code>.</li>
<li>Install node dependencies <code>npm install</code>.</li>
<li>Create <code>.env</code> file with environment variables,or you can rename <code>.env.example</code> file to <code>.env</code>.</li>
<li>Set database connection in <code>.env</code> file.</li>
<li>Go to <a href="https://pusher.com/">Pusher Dashboard</a> and create new account if you have not done before.</li>
<li>
Set following things in <code>.env</code> file
	<ul>
		<li><code>BROADCAST_DRIVER=pusher</code></li>
		<li><code>PUSHER_APP_ID=your_pusher_app_id</code></li>
		<li><code>PUSHER_APP_KEY=your_pusher_app_key</code></li>
		<li><code>PUSHER_APP_SECRET=your_pusher_app_secret</code></li>
	</ul>

</li>
<li>Open your <code>project_directory/config/broadcasting.php</code> file and find <code>connections->pusher->options</code> and set <code>cluster</code> to <code>pusher cluster value</code>.</li>
<li>Open your <code>project_directory/resources/assets/js/bootstrap.js</code> file and at the end of file set value for <code>key, cluster</code> from pusher app dashboard</code>.</li>
<li>Run migrations to generate tables in your database <code>php artisan migrate</code>.</li>
<li>
	Open cmd and go to your project directory folder and run <code>npm run watch</code>.
</li>
<li>Finally enter <code>project_directory/public</code> in the browser to run the app</li>
</ol>

<p>Enjoy chatting. Would be grateful for your feedback.</p>