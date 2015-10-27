<main>
	<table>
		<thead>
			<td>dorm id </td>
			<td>dorm name </td>
			<td>capacity</td>
			<td>occupied</td>
		</thead>
		<tbody>
			<?php foreach($dorms as $d) { ?>
			<tr>
				<td><?php echo $d->dormitory_id; ?> </td>
				<td><?php echo $d->d_name; ?></td>
				<td><?php echo $d->d_capacity; ?></td>
				<td><?php foreach($dorm_count as $d_count)
					{
						if($d_count->dorm_id = $d->dormitory_id)
							{
								echo $d_count->d_counter;
							}
					} ?></td>
			</tr>
			<?php } ?>
		</tbody>
</main>