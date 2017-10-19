
	<div class="col-md-12">
		<center>
			<div class="pagination" style="margin-top: 5px;margin-bottom: 15px;">
					<p style="margin-bottom: 0px;">
						<?= $this->Paginator->counter(array('format' => 'Página {:page} de {:pages}, mostrando {:current} registro de {:count}')); ?>
					</p>
		    		<ul class="pagination pagination-sm" style="margin-top: 5px;margin-bottom: 5px;">  
						<?= $this->Paginator->first('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1)); ?>
						<?= $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
						<?= $this->Paginator->last('>>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a')); ?>
			        </ul>
		    </div>
		</center>
	</div>
