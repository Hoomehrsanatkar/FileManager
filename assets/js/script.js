let files = document.querySelectorAll(".files .file");
let deleteBtn = document.querySelector(".delete");
let renameBtn = document.querySelector(".rename");
let createFolderBtn = document.querySelector(".create-folder");
let cutBtn = document.querySelector(".cut");
let deleteFolderBtn = document.querySelector(".delete-folder");

files.forEach(file=> {
	file.addEventListener('click', e=> {
		if(!e.ctrlKey) {
			files.forEach(s=> {
				s.classList.remove('selected');
			});
		}

		if(file.classList.contains("selected")) {
			file.classList.remove('selected');
		} else {
			file.classList.add('selected');
		}
	});

	file.addEventListener('dblclick', e=> {
		let path = file.getAttribute("data-path");

		// let req = new XMLHttpRequest();
		// req.onreadystatechange = (res)=> {
		// 	if(req.readyState == 4 && req.status == 200) {
		// 		console.log("OK!");
		// 	}
		// };

		// req.open("get", `read.php?path=${path}`, true);
		// req.send();

		window.open(`read.php?path=${path}`);
	});
})


deleteBtn.addEventListener('click', e=> {
	let selectedElm = [];

	files.forEach(file=> {
		if(file.classList.contains("selected")) {
			selectedElm.push(file.getAttribute('data-path'));
		}
	})
	if(selectedElm.length > 0) {

		if(confirm("Are You Sure?")) {
	
			let req = new XMLHttpRequest();
			req.open("get", `delete.php?items=${selectedElm}`, true);
			req.send();
		};
		location.reload();
	};
});



renameBtn.addEventListener("click", e=> {
	let selectedElm=[];

	files.forEach(file=> {
		if(file.classList.contains("selected")) {
			selectedElm.push(file.getAttribute('data-path'));
		}
	});

	if(selectedElm.length > 0 && selectedElm.length < 2) {
		
		let txtName = prompt("Enter Name:");

		let req = new XMLHttpRequest();
		req.open("get", `rename.php?items=${selectedElm}&name=${txtName}`, true);
		req.send();

		location.reload();
	}
});


createFolderBtn.addEventListener("click" , e=> {
	let path = createFolderBtn.getAttribute("data-path");
	let folderName = prompt("Pleas Enter Folder Name:");

	let req = new XMLHttpRequest();
	req.open("get", `create_folder.php?name=${folderName}&path=${path}`, true);
	req.send();

	location.reload();
});

cutBtn.addEventListener("click", e=> {
	let selectedElm=[];

	files.forEach(file=> {
		if(file.classList.contains("selected")) {
			selectedElm.push(file.getAttribute('data-path'));
		}
	});

	if(selectedElm.length >= 1) {
		let path = prompt("New Path:");

		if(!path == '') {

			let req = new XMLHttpRequest();
			req.open("get", `file_cut.php?items=${selectedElm}&path=${path}`, true);
			req.send();

			location.reload();
		}
	}
});

deleteFolderBtn.addEventListener("click", e=> {
	let path = deleteFolderBtn.getAttribute("data-path");
	let folder = prompt("Folder Name");

	path = path+'/'+folder;

	let req = new XMLHttpRequest();
	req.open("get", `file_manager.php?delete-folder=${path}`, true);
	req.send();
	
	location.reload();
});