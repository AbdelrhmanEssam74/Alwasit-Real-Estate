<?php
// function to set the title for each page contain pageTitle variable
function PageTitle()
{
    global $pageTitel;
    echo (isset($pageTitel))  ? $pageTitel : "Defult";
}
