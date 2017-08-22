<?php 
	// $this->layout = 'home'; 
?>	


<div class="users form">
<h1 style="font-weight: bold; color: red; text-decoration: underline;"> Página solo para administradores</h1>
<h1>Usuarios:</h1>
<table>
    <thead>
		<tr>
			<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
			<th><?php echo $this->Paginator->sort('username', 'Usuario');?>  </th>
			<th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
			<th><?php echo $this->Paginator->sort('created', 'Creado');?></th>
			<th><?php echo $this->Paginator->sort('modified','Modificado');?></th>
			<th><?php echo $this->Paginator->sort('role','Rol');?></th>
			<th><?php echo $this->Paginator->sort('status','Estado');?></th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>						
		<?php $count=0; ?>
		<?php foreach($users as $user): ?>				
		<?php $count ++;?>
		<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
		<?php endif; ?>
			<td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>
			<td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
			<td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
			<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
			<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
			<td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
			<td style="text-align: center;"><?php echo $user['User']['status']; ?></td>
			<td >
			<?php echo $this->Html->link("Editar", array('action'=>'edit', $user['User']['id']) ); ?> | 
			<?php
				if( $user['User']['status'] != 0){ 
					echo $this->Html->link("Desactivar", array('action'=>'delete', $user['User']['id']));}else{
					echo $this->Html->link("Reactivar", array('action'=>'activate', $user['User']['id']));
					}
			?>
			</td>
		</tr>
		<?php endforeach; ?>
		<?php unset($user); ?>
	</tbody>
</table>
	<?php echo $this->Paginator->counter(
		array('format' => 'Página{:page} de {:pages}, mostrando {:current} registro de {:count}')
		); ?>
		</p>
		
		<div class="paging">
		<?php echo $this->Paginator->first('<< primero');?>
		<?php echo $this->Paginator->prev('< anterior', array(), null, array('class' => 'prev disabled')); ?>
		<?php echo $this->Paginator->numbers(array('separator'=>'')); ?>
		<?php echo $this->Paginator->next('siguiete >', array(), null, array('class' => 'next disabled'));?>
		<?php echo $this->Paginator->last('último >>');?>
		</div>
</div>			
<?php echo $this->Html->link( "Crear usuario",   array('action'=>'add'),array('escape' => false) ); ?>
<br/>
<?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?>

