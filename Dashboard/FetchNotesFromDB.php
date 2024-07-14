<?php
    session_start();
    require '../db.php';

    $user_id = $_SESSION['user_id'];
    $NoteItems = '';
    
    $sql = "SELECT * FROM notes WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $noteid = $row['id'];
            $title = $row['title'];
            $content = $row['content'];

            $NoteItems.='
                        <div class="NoteItem">
                            <div class="NoteTitle">Title:   '.$row['title'].'</div>
                            <div class="NoteButtons">
                                <input class="NoteButton edit" type="button" value="View" id="ButtonNoteEdit'.$row['id'].'"       onclick="ViewNote('.$row['id'].')">
                                <input class="NoteButton delete" type="button" value="Delete" id="ButtonNoteDelete'.$row['id'].'" onclick="DeleteNote('.$row['id'].')">
                                <div class="loader popupnotedelete" id="popupnoteloader'.$row['id'].'"></div>
                            </div>
                            <form id="HiddenNoteForm">
                                <input type="hidden" name="id" id="noteid'.$row['id'].'" value="'.$row['id'].'">
                                <input type="hidden" name="title" id="notetitle'.$row['id'].'" value="'.$row['title'].'">
                                <input type="hidden" name="contennt" id="notecontent'.$row['id'].'" value="'.$row['content'].'">
                            </form>
                        </div>
            ';
        }
    } else $NoteItems='<div class="NotesMessage"> You have no notes. Make one! </div>'; //(Optional) No Notes Message <element>

    echo $NoteItems;