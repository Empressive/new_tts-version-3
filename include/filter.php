<div id="date_filter"><button id="date_button"><img id="res_img" src="/img/closer.png"></button></div>
<div id="reset_button"><button id="res_button"><img id="res_img" src="/img/trash.png"></button></div>
<table class="filter">
    <tr>
        <th>Статус</th>
        <th>Категория</th>
        <th id="old_date">Дата</th>
        <th id="date_col">Кон. дата</th>
        <th>Исполнитель</th>
        <th>Заявка</th>
        <th>Договор</th>
    </tr>
    <tr>
        <td><select class="input_filter" name='status'
                    id='status'>
                <?php
                $user_id = $_SESSION['user_id'];

                $query = mysql_query("SELECT status, status_id FROM staff_login INNER JOIN status USING (status_id) WHERE id = {$user_id}");
                $result = mysql_fetch_assoc($query);

                echo "<option selected value='{$result['status_id']}'>{$result['status']}</option>";
                MVdb::select(status, status, status_id, "WHERE status_id !={$result['status_id']}", 'status_id')
                ?></select></td>
        <td><select class="input_filter" name='category'
                    id='category'>
                <?php
                $query = mysql_query("SELECT category, category_id FROM staff_login INNER JOIN category USING (category_id) WHERE id = {$user_id}");
                $result = mysql_fetch_assoc($query);

                echo "<option selected value='{$result['category_id']}'>{$result['category']}</option>";
                MVdb::select(category, category, category_id, "WHERE category_id !={$result['category_id']}", 'category_id')
                ?>
            </select>
        </td>
        <?php
        $query = mysql_query("SELECT time_date FROM staff_login WHERE id = {$user_id}");
        $result = mysql_fetch_assoc($query);

        echo "<td><input class='input_filter' id='datepicker' name='date' autocomplete='off' value='{$result['time_date']}'></td>"
        ?>
        <td id="date_col2">
            <input class='input_filter' id='end_date' name='end_date' autocomplete='off'>
        </td>
        <td><select class="input_filter" name='staffGroup' id='staffGroup'>
                <?php
                $query = mysql_query("SELECT group_id FROM staff_login WHERE id = {$user_id}");
                $result = mysql_fetch_assoc($query);

                $query = mysql_query("SELECT staff_group FROM staff_group WHERE staff_group_id = {$result['group_id']}");
                $result = mysql_fetch_assoc($query);

                echo "<option selected value='{$result['group_id']}'>{$result['staff_group']}</option>";

                MVdb::select(staff_group, staff_group, staff_group_id, "WHERE staff_group_id !={$result['group_id']}", 'staff_group_id')
                ?><
            </select>
        </td>
        <td><input class="input_filter" name='application' autocomplete='off' onchange="this.form.submit()">
        </td>
        <?php
        $query = mysql_query("SELECT agreement FROM staff_login WHERE id = {$user_id}");
        $result = mysql_fetch_assoc($query);

        echo "<td><input class='input_filter' name='agreement' autocomplete='off' id='agreement' value='{$result['agreement']}'></td>"
        ?>
    </tr>
</table>
