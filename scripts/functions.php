<?php
function getcomments($row, $handler) //рекурсивная функция для получения вложенных комментариев, при -1 в параметре получим первый уровень (вызов функции), при других значениям будем искать строки в БД, где id == parent (искать вложенные)
		{
			if($row == -1) $query = "SELECT * FROM `comments` WHERE `lvl` = 1 ORDER BY `date`";
			else $query = "SELECT * FROM `comments` WHERE `parent`=".$row." ORDER BY `date`";
			$stmt = $handler->prepare($query);
			$stmt->execute();			
			if($stmt->rowCount() == 0) { return; }
			echo '<div id="comwrapper">';
			foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $r)
			{
				echo '<div id=maindiv_'.$r['id'].' class="lvl_'.$r['lvl'].'" >';
				echo '<span id='.$r['id'].'>'.$r['text'].'</span> <span class="date">('.$r['date'].')</span> <button class="btnNewComment" id = newcomment_'.$r['id'].' OnClick="ShowCommentArea('.$r['id'].')"> Comment </button>
				<button class="btnDeleteComment" id = deletecomment_'.$r['id'].' OnClick="DeleteComment('.$r['id'].')"> Delete </button><br/>';
				echo '<div style="display:none" id="div_'.$r['id'].'"><textarea id="textarea_'.$r['id'].'"></textarea><br/> <button id="textarea_'.$r['id'].'" OnClick="NewComment('.$r['id'].')">Send</button></div>';
				echo '</div>';
				getcomments($r['id'], $handler);

			}
			echo '</div>';
		}