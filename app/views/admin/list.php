<hr>
<div class = "container">
	<form action="" method="POST">
		<label for="sort-by">Sort by:</label>
		<select name="sort-by" id="sort-by">
			<option value="name" <?if (isset($_SESSION['SORT_BY']) && $_SESSION['SORT_BY'] == 'name'):?> selected <?endif?> >Name</option>
			<option value="login" <?if (isset($_SESSION['SORT_BY']) && $_SESSION['SORT_BY'] == 'login'):?> selected <?endif?>>Login</option>
		</select><br>

		<label for="sort-direction">Sort direction:</label>
		<select name="sort-direction" id="sort-direction">
			<option value="ASC" <?if (isset($_SESSION['SORT_DIRECTION']) && $_SESSION['SORT_DIRECTION'] == 'ASC'):?> selected <?endif?>>Direct order</option>
			<option value="DESC" <?if (isset($_SESSION['SORT_DIRECTION']) && $_SESSION['SORT_DIRECTION'] == 'DESC'):?> selected <?endif?>>Reverse order</option>
		</select><br>
		<input type="submit" value="Sort" class="btn btn-primary">
	</form><hr>
	<div class = "row">
		<div class = "col-sm-12">
			<?if($users):?>
				<?foreach ($users as $user): ?>
				<form action="/admin/delete/<? echo $user['id'];?>" method="POST" class="user-form">
					<div class = "row">
						<div class = "col-sm-3">
							<label for="login">Login:</label>
						</div>
						<div class = "col-sm-9">
							<input name="login" type="text" disabled value=<?=$user['login']?>>
						</div>
					</div>

					<div class = "row">
						<div class = "col-sm-3">
							<label for="name">Name:</label>
						</div>
						<div class = "col-sm-9">
							<input name="name" type="text" disabled value=<?=$user['name']?>>
						</div>
					</div>

					<div class = "row">
						<div class = "col-sm-3">
							<label for="second_name">Second name:</label>
						</div>
						<div class = "col-sm-9">
							<input name="second_name" type="text" disabled value=<?=$user['second_name']?>>
						</div>
					</div>

					<div class = "row">
						<div class = "col-sm-3">
							<label for="gender">Gender:</label>
						</div>
						<div class = "col-sm-9"> 
							<input name="gender" type="text" disabled value=<?=$user['gender']?>>
						</div>
					</div>

					<div class = "row">
						<div class = "col-sm-3">
							<label for="date_of_birth">Date of birth:</label>
						</div>
						<div class = "col-sm-9"> 
							<input name="date_of_birth" type="date" disabled value=<?=$user['date_of_birth']?>>
						</div>
					</div>
					<div class = "row">
						 <div class = "col-sm-4"> 
							<a href="/admin/detail/<? echo $user['id'];?>" class="btn btn-primary more-button">Rread more/edit</a > 						
						</div> 
						<div class = "col-sm-4">				
							<input type="submit" value="Delete" class="btn btn-danger">
						</div>
					</div>
					<div class = "error-block" class = "row">
						<div class = "col-sm-12">
							<p class="error-text"></p>
						</div>
					</div>
				</form>

					

				<hr>
				<?endforeach;?>
			<?else:?>
				<p>Список задач пуст!</p>
			<?endif;?>

		</div>
	</div>
	<div class="clearfix">
        <?php echo $pagination; ?>
    </div>
</div>

