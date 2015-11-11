<?php 
require __DIR__ . '/process.php'; ?>
<div class="col-md-12">
	<h1>MODx Migration Wizard</h1>
</div>
<form action="" method="POST" target="output_iframe">
<div class="col-md-12 well">
	<h3>Config constants</h3>
	<?php $divideAt = round(count($modxConstants) / 2); ?>
	<?php $counter = 0; ?>
	<div class="row">
		<?php foreach ($modxConstants as $constantName => $value): ?>
			<?php echo $counter == 0 || $counter == $divideAt ? '<div class="col-md-6">' : ''; ?>
			<label class="form-item">
				<?php echo $constantName; ?>
				<input class="form-control" type="text" name="<?php echo $constantName; ?>" value="<?php echo $value; ?>" 
				       <?php echo in_array($constantName, $disabledConstants) ? 'disabled' : ''; ?>>
			</label>
			<?php echo $counter + 1 == $divideAt ? '</div>' : ''; $counter++; ?>
		<?php endforeach; ?>
		</div>
	</div>
	<div class="text-center">
		Disabled constants will be modified automatically.
	</div>
</div>
	<div class="col-md-6">
		<h2>Change database info</h2>
		<h3>Database Type: <?php echo $database_type; ?></h3>
		<label class="form-item">
			Database Server:
			<input class="form-control" type="text" name="database_server" value="<?php echo $database_server; ?>">
		</label>
		<label class="form-item">
			Database User:
			<input class="form-control" type="text" name="database_user" value="<?php echo $database_user; ?>">
		</label>
		<label class="form-item">
			Database Password:
			<input class="form-control" type="text" name="database_password" value="<?php echo $database_password; ?>">
		</label>
		<label class="form-item">
			Database Connection Charset:
			<input class="form-control" type="text" name="database_connection_charset" value="<?php echo $database_connection_charset; ?>">
		</label>
		<label class="form-item">
			Database Name:
			<input class="form-control" type="text" name="dbase" value="<?php echo $dbase; ?>">
		</label>
		<label class="form-item">
			DSN:
			<input class="form-control" type="text" name="database_dsn" value="<?php echo $database_dsn; ?>">
		</label>
		<label class="form-item">
			Table Prefix:
			<input class="form-control" type="text" name="table_prefix" value="<?php echo $table_prefix; ?>">
		</label>
	</div>
	<div class="col-md-6 well">
		<h4>Following changes will be applied:</h2>
		<ul>
			<?php foreach ($fixMap as $filePatb => $config): ?>
			<li><?php echo $filePatb; ?>, Actions:
				<ul>
					<?php if (is_array($config['description'])): ?>
					<?php foreach ($config['description'] as $item): ?>
					<li><?php echo $item; ?></li>
					<?php endforeach; ?>
					<?php else: ?>
					<li><?php echo $config['description']; ?></li>
					<?php endif; ?>
				</ul>
			</li>
			<?php endforeach; ?>
		</ul>
		<iframe name="output_iframe" src="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]?iframe=1" ?>" class="fix-output" frameborder="0"></iframe>
	</div>
	<div class="col-md-12 text-center buttons">
		<input type="submit" name="migrate" value="Migrate to this server!" class="btn btn-success">
	</div>
</form>