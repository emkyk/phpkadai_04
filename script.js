document.addEventListener('DOMContentLoaded', function() {
    // モーダル要素
    var editModal = document.getElementById('editModal');
    var deleteModal = document.getElementById('deleteModal');
    var spanEdit = document.getElementsByClassName('close')[0];
    var spanDelete = document.getElementsByClassName('close')[1];
    var deleteTaskId = null;

    // 編集リンクにイベントリスナーを追加
    document.querySelectorAll('.edit-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // デフォルトのリンク動作を防止
            const id = this.getAttribute('data-id');
            const row = this.closest('tr');
            const taskName = row.querySelector('td[data-label="Task Name"]').textContent;
            const dueDate = row.querySelector('td[data-label="Due Date"]').textContent;
            const priority = row.querySelector('td[data-label="Priority"]').textContent;
            const status = row.querySelector('td[data-label="Status"]').textContent;

            // 編集モーダルにタスクデータを設定
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_task_name').value = taskName;
            document.getElementById('edit_due_date').value = dueDate;
            document.getElementById('edit_priority').value = priority;
            document.getElementById('edit_status').value = status;

            editModal.style.display = 'block'; // 編集モーダルを表示
        });
    });

    // 編集フォームの送信イベント
    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault(); // フォーム送信を防止
        const id = document.getElementById('edit_id').value;
        const taskName = document.getElementById('edit_task_name').value;
        const dueDate = document.getElementById('edit_due_date').value;
        const priority = document.getElementById('edit_priority').value;
        const status = document.getElementById('edit_status').value;

        // デバッグメッセージ
        console.log('Saving task:', { id, taskName, dueDate, priority, status });

        // AJAXリクエストを作成してタスクを更新
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_task.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // デバッグメッセージ
                console.log('Update successful:', xhr.responseText);

                // 更新後の値をセルに設定
                const row = document.querySelector(`tr[data-id="${id}"]`);
                row.querySelector('td[data-label="Task Name"]').textContent = taskName;
                row.querySelector('td[data-label="Due Date"]').textContent = dueDate;
                row.querySelector('td[data-label="Priority"]').textContent = priority;
                row.querySelector('td[data-label="Status"]').textContent = status;

                // モーダルを非表示にする
                editModal.style.display = 'none';
            } else {
                console.error('An error occurred:', xhr.statusText);
            }
        };
        xhr.send(`id=${id}&task_name=${encodeURIComponent(taskName)}&due_date=${encodeURIComponent(dueDate)}&priority=${encodeURIComponent(priority)}&status=${encodeURIComponent(status)}`);
    });

    // キャンセルボタンのイベント
    document.getElementById('cancelEdit').addEventListener('click', function() {
        editModal.style.display = 'none'; // 編集モーダルを非表示にする
    });

    // モーダルを閉じる
    spanEdit.onclick = function() {
        editModal.style.display = 'none'; // 編集モーダルを非表示にする
    };

    window.onclick = function(event) {
        if (event.target == editModal) {
            editModal.style.display = 'none'; // 編集モーダルを非表示にする
        }
        if (event.target == deleteModal) {
            deleteModal.style.display = 'none'; // 削除確認モーダルを非表示にする
        }
    };

    // 削除リンクにイベントリスナーを追加
    document.querySelectorAll('.delete-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // デフォルトのリンク動作を防止
            console.log('Delete link clicked'); // デバッグメッセージ
            deleteTaskId = this.getAttribute('data-id'); // 削除対象のタスクIDを取得
            const taskName = this.getAttribute('data-task'); // 削除対象のタスク名を取得
            document.getElementById('taskToDelete').textContent = taskName; // モーダルにタスク名を設定
            console.log('Task ID to delete:', deleteTaskId); // デバッグメッセージ
            deleteModal.style.display = 'block'; // 削除確認モーダルを表示
        });
    });

    // 削除確認モーダルのOKボタンにイベントリスナーを追加
    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (deleteTaskId) {
            // デバッグメッセージ
            console.log('Confirmed deletion of task ID:', deleteTaskId);
            // AJAXリクエストを作成してタスクを削除
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `delete_task.php?id=${deleteTaskId}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const row = document.querySelector(`tr[data-id="${deleteTaskId}"]`);
                    row.remove(); // タスクをテーブルから削除
                    deleteModal.style.display = 'none'; // 削除確認モーダルを非表示にする
                } else {
                    console.error('An error occurred:', xhr.statusText);
                }
            };
            xhr.send();
        }
    });

    // 削除確認モーダルのキャンセルボタンにイベントリスナーを追加
    spanDelete.onclick = function() {
        deleteModal.style.display = 'none'; // 削除確認モーダルを非表示にする
    };

    // 編集モーダルを閉じる関数
    function closeEditModal() {
        editModal.style.display = 'none'; // 編集モーダルを非表示にする
    }

    // 削除確認モーダルを閉じる関数
    function closeDeleteModal() {
        deleteModal.style.display = 'none'; // 削除確認モーダルを非表示にする
    }
});
