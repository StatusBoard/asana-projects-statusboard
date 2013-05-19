<table id="projects">
	<?php foreach ($data as $project): ?>
	<tr>
		<td class="projectName">
			<?php echo $project['name']; ?>
		</td>
		<td class="projectVersion noresize">
			<?php echo sprintf('%s/%s', $project['completedCount'], $project['totalCount']); ?>
		</td>
		<td class="projectsBars">
	<?php
		$c = (int) $project['completedCount'];
		$t = (int) $project['totalCount'];
		
		if ($t > 0):
		?>
		<?php
			$bars = range(8, $t * 8, $t);
			sort($bars, SORT_NUMERIC);
			foreach($bars as $k => $v): 
				if ($v <= $c * 8):
		?>
			<div class="barSegment value<?php echo $k + 1; ?>"></div>
		<?php 
				else:
		?>
			<div class="barSegment"></div>
		<?php
				endif;
			endforeach;
		endif;
	?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>