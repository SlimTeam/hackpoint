<?php require_once __DIR__.DIRECTORY_SEPARATOR.'header.php'; ?>

	<?php if (!$myUser->connected()) {
    header('location: index.php');
} ?>

	<div class="row">
	<div class="col-md-12">
		<h3>Plugins</h3>
		<ul id="plugins" class="list-group">
			<li class="list-group-item" style="display:none;" data-id="{{id}}">
				<h4 class="list-group-item-heading">{{name}} <span class="label label-info">v{{version}}</span></h4>
				<p class="list-group-item-text">{{description}}</p>
				
				<a class="pointer" onclick="$(this).next('ul').slideToggle(200);"><i class="fa fa-search"></i> + d'Infos</a>
				<ul style="display:none;">
					<li>ID : {{id}}</li>
					<li><span class="label label label-default">{{author.name}}</span></li>
					<li>Licence: {{#licence.url}}<a href="{{licence.url}}">{{/licence.url}}{{licence.name}}{{#licence.url}}</a>{{/licence.url}}</li>
					<li>Version: <code>{{version}}</code></li>
					<li>Site web: <a href="{{url}}">{{url}}</a></li>
					<li>Dossier: {{folder.path}}</li>
					<li>Pré-requis : <ul>{{#require}}<li>{{key}} - <span class="label label-info">{{value}}</span></li>{{/require}}</ul></li>
				</ul>
				<label class="activator">
					<small>On/Off</small>
					<label class="toggle">
						<input {{#state}}checked=""{{##state}} type="checkbox">
						<span class="handle"></span>
					</label>
				</label>
				
			</li>
		</ul>
	</div>
</div>

<?php require_once __ROOT__.'footer.php' ?>
