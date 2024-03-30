<!-- view/home/index.php -->
<body onload="load_todo_today(); search_cases();">
	<div class="container">
		<div id="home_webpage" class="col-sm-10">
			<div id="error_message_div">
				<input id="error_message" disabled>
			</div>
			<hr />
			<!-- Todo List -->
			<div id="todo_container" class="col-md-4">
				<div class="row d-flex">
					<div class="card rounded-3 card-body p-4">
						<div id="top_todo">
							<p class="mb-2">
								<span class="h2 me-2" id='day'></span><span
									class="badge bg-light">checklist</span>
							</p>
							<div class="row">
								<button id="previous_day" class="todo_button">
									<i class="fa fa-solid fa-chevron-left"></i>
								</button>
								<!-- JS FILLED DATE -->
								<div id="today_todo"></div>
								<button id="next_day" class="todo_button">
									<i class="fa fa-solid fa-chevron-right"></i>
								</button>
							</div>
						</div>
						<br />
						<div id="todo_tasks">
						<input type='hidden' value='todo_list' id='table_name' name='table_name'/>
							<form action="" method="POST" id="form" onsubmit='save_task(0)'>
								<input type="hidden" value="1" id="total_tasks"
									name='total_tasks'>
								<ul id="todo_list" class="list-group rounded-0"></ul>
								<li class='list-group-item border-0 d-flex align-items-center ps-0'>
									<button class='form-check-input me-3' class="todo_button"
										id='add-task-button'>
										<i class="fa fa-plus-circle"></i>
									</button> <input id="task0" type="text" value=""
									placeholder="New Task Text" required/>
								</li>
							</form>
						</div>
					</div>
				</div>
			</div>
    			<form action="" method="POST">
        			<div id="search_case_list">
        			    <button id='case_list_search_button' class='btn' type='submit' onsubmit='search_cases();'>Search</button>
        				<input id='case_list_search_bar' name='case_list_search_bar' type='text' placeholder='00-000(0)' 
        				value="<?php if(isset($_POST['case_list_search_bar'])){echo $_POST['case_list_search_bar']; } ?>" required>
        			    <div id='case_list' class="col-sm-8"></div>
        			</div>
    			</form>
		</div>
	</div>