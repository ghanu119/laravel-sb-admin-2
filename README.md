<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
<h1 class="code-line" data-line-start=1 data-line-end=2 ><a id="Laravel_SB_Admin_2_1"></a>Laravel SB Admin 2</h1>
<h2 class="code-line" data-line-start=2 data-line-end=3 ><a id="Laravel_8__SB_Admin__1_CRUD_Operation_2"></a>Laravel 8 + SB Admin + 1 CRUD Operation</h2>
<p class="has-line-data" data-line-start="4" data-line-end="5"><a href="https://nodesource.com/products/nsolid"><img src="https://cldup.com/dTxpPi9lDf.thumb.png" alt="N|Solid"></a></p>
<p class="has-line-data" data-line-start="6" data-line-end="7"><a href="https://travis-ci.org/joemccann/dillinger"><img src="https://travis-ci.org/joemccann/dillinger.svg?branch=master" alt="Build Status"></a></p>
<p class="has-line-data" data-line-start="8" data-line-end="9">Laravel SB Admin 2 is a ready to use admin panel.</p>
<h2 class="code-line" data-line-start=10 data-line-end=11 ><a id="Features_10"></a>Features</h2>
<ul>
<li class="has-line-data" data-line-start="11" data-line-end="12">Admin Login</li>
<li class="has-line-data" data-line-start="12" data-line-end="13">Admin Forgot password</li>
<li class="has-line-data" data-line-start="13" data-line-end="14">Admin Reset Password [ Mail with Reset Password Link]</li>
<li class="has-line-data" data-line-start="14" data-line-end="15">Admin Profile Update</li>
<li class="has-line-data" data-line-start="15" data-line-end="16">Admin Profile Password change</li>
<li class="has-line-data" data-line-start="16" data-line-end="18">Create, Update, Delete module [ Image upload is supported ]</li>
</ul>
<h2 class="code-line" data-line-start=18 data-line-end=19 ><a id="Tech_18"></a>Tech</h2>
<p class="has-line-data" data-line-start="20" data-line-end="21">Dillinger uses a number of open source projects to work properly:</p>
<ul>
<li class="has-line-data" data-line-start="22" data-line-end="23"><a href="http://laravel.com/docs/8.x">Laravel 8</a>- An open source framework!</li>
<li class="has-line-data" data-line-start="23" data-line-end="24"><a href="https://startbootstrap.com/theme/sb-admin-2">SB Admin 2</a> - Thank to StartBootstrap for this admin panel</li>
<li class="has-line-data" data-line-start="24" data-line-end="25"><a href="https://gruntjs.com/">GruntJS</a> - To combine and minnify the assets JS and CSS files.</li>
<li class="has-line-data" data-line-start="25" data-line-end="26">[Sweet Alert] (<a href="https://sweetalert.js.org/guides/#installation">https://sweetalert.js.org/guides/#installation</a>) - A great library to show alert and confirm box.</li>
<li class="has-line-data" data-line-start="26" data-line-end="28"><a href="https://datatables.net/">jQuery DataTable</a> - A great table plugins to show the data in the table format.</li>
</ul>
<h2 class="code-line" data-line-start=28 data-line-end=29 ><a id="Installation_28"></a>Installation</h2>
<p class="has-line-data" data-line-start="30" data-line-end="31">Laravel SB Admin 2 requires <a href="http://laravel.com/docs/8.x">Laravel 8</a> v10+ to run.</p>
<p class="has-line-data" data-line-start="32" data-line-end="33">Install the dependencies and devDependencies and start the server.</p>
<pre><code class="has-line-data" data-line-start="35" data-line-end="40" class="language-sh">composer install
npm i
php artisan migrate
php artisan db:seed --class=AdminUserSeeder
</code></pre>
<h2 class="code-line" data-line-start=41 data-line-end=42 ><a id="Admin_Credentials_41"></a>Admin Credentials</h2>
<pre><code class="has-line-data" data-line-start="44" data-line-end="46">admin@nomail.com / admin@123
</code></pre>
<h3 class="code-line" data-line-start=46 data-line-end=47 ><a id="Custom_Plugin_file_46"></a>Custom Plugin file</h3>
<p class="has-line-data" data-line-start="47" data-line-end="48">There is <code>custom-plugin.js</code> inside <code>public/assets/admin/js</code>. File has been created for reuse of jquery related task.</p>
<h4 class="code-line" data-line-start=49 data-line-end=50 ><a id="Grunt_49"></a>Grunt</h4>
<p class="has-line-data" data-line-start="51" data-line-end="52">There is <code>Gruntfile.js</code> in the root directory. If you are adding new JS/CSS file then you have to add that file into this file and then run following command:</p>
<pre><code class="has-line-data" data-line-start="54" data-line-end="56" class="language-sh">grunt
</code></pre>
<p class="has-line-data" data-line-start="57" data-line-end="58">It will create new single minify and combined for each js and css file.</p>
<h2 class="code-line" data-line-start=60 data-line-end=61 ><a id="License_60"></a>License</h2>
<p class="has-line-data" data-line-start="62" data-line-end="63">MIT</p>
<p class="has-line-data" data-line-start="64" data-line-end="65"><strong>Free Software, Hell Yeah!</strong></p>