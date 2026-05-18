<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../Index.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Administrator Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($user['name']); ?> (<?php echo htmlspecialchars($user['email']); ?>)</p>
        <a href="../logout.php">Logout</a>
        <a href="../Index.php">Public Site</a>
    </header>

    <main>
        <section>
            <h2>Summary</h2>
            <p>Role: <?php echo htmlspecialchars($user['role']); ?></p>
            <p>Username: <?php echo htmlspecialchars($user['username']); ?></p>
        </section>

        <section id="courseManager">
            <h2>Courses</h2>
            <form id="courseForm">
                <input type="hidden" name="id" id="course_id">
                <label>Code: <input name="code" id="course_code"></label>
                <label>Title: <input name="title" id="course_title"></label>
                <label>Credits: <input name="credits" id="course_credits" type="number" value="0"></label>
                <label>Description:<br><textarea name="description" id="course_description"></textarea></label>
                <button type="submit">Save Course</button>
                <button type="button" id="courseReset">Reset</button>
            </form>
            <div id="coursesList"></div>
        </section>

        <section id="assignmentManager">
            <h2>Assignments</h2>
            <form id="assignmentForm">
                <input type="hidden" name="id" id="assignment_id">
                <label>Course: <select id="assignment_course" name="course_id"></select></label>
                <label>Title: <input name="title" id="assignment_title"></label>
                <label>Due Date: <input type="datetime-local" name="due_date" id="assignment_due_date"></label>
                <label>Description:<br><textarea name="description" id="assignment_description"></textarea></label>
                <button type="submit">Save Assignment</button>
                <button type="button" id="assignmentReset">Reset</button>
            </form>
            <div id="assignmentsList"></div>
        </section>

        <section id="importManager">
            <h2>Import CSV</h2>
            <p>Upload CSV files to bulk import users, courses, or assignments.</p>
            <form id="importForm" enctype="multipart/form-data">
                <label>Type:
                    <select name="type" id="import_type">
                        <option value="users">Users (username,name,email,password,role)</option>
                        <option value="courses">Courses (code,title,description,credits)</option>
                        <option value="assignments">Assignments (course_code,title,description,due_date,created_by_username)</option>
                    </select>
                </label>
                <label>File: <input type="file" name="file" id="import_file" accept=".csv"></label>
                <button type="submit">Import</button>
            </form>
            <div id="importResult"></div>
        </section>
    </main>

    <script>
    async function fetchCourses() {
        const res = await fetch('../Backend/api/courses.php');
        const data = await res.json();
        const list = document.getElementById('coursesList');
        const select = document.getElementById('assignment_course');
        list.innerHTML = '';
        select.innerHTML = '';
        if (data.success) {
            data.courses.forEach(c => {
                const div = document.createElement('div');
                div.innerHTML = `<strong>${c.code}</strong> - ${c.title} (${c.credits}) <button data-id="${c.id}" class="editCourse">Edit</button> <button data-id="${c.id}" class="delCourse">Delete</button>`;
                list.appendChild(div);
                const opt = document.createElement('option'); opt.value = c.id; opt.textContent = c.title; select.appendChild(opt);
            });
        }
    }

    async function fetchAssignments() {
        const res = await fetch('../Backend/api/assignments.php');
        const data = await res.json();
        const list = document.getElementById('assignmentsList');
        list.innerHTML = '';
        if (data.success) {
            data.assignments.forEach(a => {
                const div = document.createElement('div');
                const due = a.due_date ? (' - due: '+a.due_date) : '';
                div.innerHTML = `<strong>${a.title}</strong> (${a.course_title || 'No course'})${due} <button data-id="${a.id}" class="editAssignment">Edit</button> <button data-id="${a.id}" class="delAssignment">Delete</button>`;
                list.appendChild(div);
            });
        }
    }

    document.getElementById('courseForm').addEventListener('submit', async e => {
        e.preventDefault();
        const form = e.target;
        const id = document.getElementById('course_id').value;
        const fd = new FormData(form);
        fd.append('action', id ? 'update' : 'create');
        if (id) fd.append('id', id);
        const res = await fetch('../Backend/api/courses.php', {method:'POST', body: fd});
        const json = await res.json();
        if (json.success) { fetchCourses(); form.reset(); }
        else alert(json.error || 'Error');
    });

    document.getElementById('courseReset').addEventListener('click', () => document.getElementById('courseForm').reset());

    document.getElementById('coursesList').addEventListener('click', async e => {
        if (e.target.classList.contains('editCourse')) {
            const id = e.target.dataset.id;
            const res = await fetch('../Backend/api/courses.php');
            const json = await res.json();
            const c = json.courses.find(x=>x.id==id);
            if (c) {
                document.getElementById('course_id').value = c.id;
                document.getElementById('course_code').value = c.code;
                document.getElementById('course_title').value = c.title;
                document.getElementById('course_credits').value = c.credits;
                document.getElementById('course_description').value = c.description;
            }
        }
        if (e.target.classList.contains('delCourse')) {
            if (!confirm('Delete course?')) return;
            const fd = new FormData(); fd.append('action','delete'); fd.append('id', e.target.dataset.id);
            const res = await fetch('../Backend/api/courses.php', {method:'POST', body: fd});
            const json = await res.json(); if (json.success) fetchCourses(); else alert(json.error||'Error');
        }
    });

    document.getElementById('assignmentForm').addEventListener('submit', async e => {
        e.preventDefault();
        const form = e.target;
        const id = document.getElementById('assignment_id').value;
        const fd = new FormData(form);
        fd.append('action', id ? 'update' : 'create');
        if (id) fd.append('id', id);
        const res = await fetch('../Backend/api/assignments.php', {method:'POST', body: fd});
        const json = await res.json();
        if (json.success) { fetchAssignments(); form.reset(); }
        else alert(json.error || 'Error');
    });

    document.getElementById('assignmentsList').addEventListener('click', async e => {
        if (e.target.classList.contains('editAssignment')) {
            const id = e.target.dataset.id;
            const res = await fetch('../Backend/api/assignments.php');
            const json = await res.json();
            const a = json.assignments.find(x=>x.id==id);
            if (a) {
                document.getElementById('assignment_id').value = a.id;
                document.getElementById('assignment_course').value = a.course_id;
                document.getElementById('assignment_title').value = a.title;
                if (a.due_date) document.getElementById('assignment_due_date').value = a.due_date.replace(' ', 'T');
                document.getElementById('assignment_description').value = a.description;
            }
        }
        if (e.target.classList.contains('delAssignment')) {
            if (!confirm('Delete assignment?')) return;
            const fd = new FormData(); fd.append('action','delete'); fd.append('id', e.target.dataset.id);
            const res = await fetch('../Backend/api/assignments.php', {method:'POST', body: fd});
            const json = await res.json(); if (json.success) fetchAssignments(); else alert(json.error||'Error');
        }
    });

    // init
    fetchCourses();
    fetchAssignments();
    // import handler
    document.getElementById('importForm').addEventListener('submit', async e => {
        e.preventDefault();
        const form = e.target;
        const fd = new FormData(form);
        const res = await fetch('../Backend/api/import.php', {method:'POST', body: fd});
        const json = await res.json();
        const result = document.getElementById('importResult');
        if (json.success) {
            result.innerText = `Imported: ${json.imported}. Errors: ${json.errors.length}`;
            if (json.errors.length) result.innerHTML += '<pre>'+json.errors.join('\n')+'</pre>';
            fetchCourses(); fetchAssignments();
        } else {
            result.innerText = json.error || 'Import failed';
        }
    });
    </script>
</body>
</html>
