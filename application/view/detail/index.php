<form action='<? echo URL . 'tickets/edit/' . $items['id'] . '/'; ?>' method='post'>
    <script src='<? echo RESOURCES . 'js/detail.js' ?>'></script>
    <table width='30%' align='left' border='1' id='detail_table'>
        <tr>
            <th colspan='2'>Данные по заявке №<? echo $items['id']; ?></th>
        </tr>
        <tr>
            <td>Дата выполнения:</td>
            <td><input value='<? echo $items['time_date'];
                echo $access; ?>' id='datepicker' type='text' name='time_date'></td>
        </tr>
        <tr>
            <td>Дата поступления:</td>
            <td><? echo $items['now_date']; ?></td>
        </tr>
        <tr>
            <td>Статус заявки:</td>
            <td>
                <select name='status' <? echo $access ?>>
                    <option value='<? echo $items['status_id']; ?>'><? echo $items['status']; ?></option>
                    <?
                    foreach ($statuses as $status) {
                        echo "<option value='{$status['status_id']}'>{$status['status']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Категория заявки:</td>
            <td>
                <select name='category' <? echo $access ?>>
                    <option value='<? echo $items['category_id']; ?>'><? echo $items['category']; ?></option>
                    <?
                    foreach ($categoryes as $category) {
                        echo "<option value='{$category['category_id']}'>{$category['category']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Заявку принял:</td>
            <td><? echo $items['staff_name']; ?></td>
        </tr>
        <tr>
            <td>Исполнитель:</td>
            <td>
                <select name='staff_group' <? echo $access ?>>
                    <option value='<? echo $items['staff_group_id']; ?>'><? echo $items['staff_group']; ?></option>
                    <?
                    foreach ($staff_groups as $staff_group) {
                        echo "<option value='{$staff_group['staff_group_id']}'>{$staff_group['staff_group']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Номер договора:</td>
            <td><? echo "<a href='/filter/view/{$link}/' target='_blank'>{$items['agreement']}</a>"; ?></td>
        </tr>
        <tr>
            <td>IP адрес:</td>
            <td><? echo $items['ip_adress']; ?></td>
        </tr>
        <tr>
            <td>Ф.И.О. клиента:</td>
            <td><? echo $items['user_name']; ?></td>
        </tr>
        <tr>
            <td>Населенный пункт:</td>
            <td>
                <select name='location' <? echo $access ?>>
                    <option value='<? echo $items['location_id']; ?>'><? echo $items['location']; ?></option>
                    <?
                    foreach ($locations as $location) {
                        echo "<option value='{$location['location_id']}'>{$location['location']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Дом:</td>
            <td><input type='text' <? echo $access; ?> value='<? echo $items['house']; ?>' name='house'></td>
        </tr>
        <tr>
            <td>Подъезд:</td>
            <td><input type='text' <? echo $access; ?> value='<? echo $items['driveway']; ?>' name='driveway'></td>
        </tr>
        <tr>
            <td>Этаж:</td>
            <td><input type='text' <? echo $access; ?> value='<? echo $items['floor']; ?>' name='floor'></td>
        </tr>
        <tr>
            <td>Квартира:</td>
            <td><input type='text' <? echo $access; ?> value='<? echo $items['flat']; ?>' name='flat'></td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td><input type='text' id='phone' <? echo $access; ?> value='<? echo $items['phone']; ?>' name='phone'></td>
        </tr>
        <tr>
            <td colspan='2' id='td_color'>Текст заявки</td>
        </tr>
        <tr>
            <td colspan='2'><textarea <? echo $access; ?> name='comment'
                                                          maxlength='500'><? echo $items['comment']; ?></textarea></td>
        </tr>
        <tr>
            <td colspan='2'><input type='submit' value='Сохранить' <? echo $access; ?>></td>
        </tr>
    </table>
</form>
<form>
    <table width='69%' align='right' border='1' id='detail_table2'>
        <tr>
            <th colspan='3'>Информация о заявке</th>
        </tr>
        <tr>
            <td>Дата</td>
            <td>Сотрудник</td>
            <td>Комментарий</td>
        </tr>
        <?
        if ($comment_rows > 1) {
            foreach ($comments as $comment) {
                if ($comment['type_id'] == 1) $color = '#cccccc';
                if (strripos($comment['comment'], 0x20) === false) {
                    $comment['comment'] = mb_substr($comment['comment'], 0, 30) . '...';
                }
                echo "<tr bgcolor='$color'><td>{$comment['now_date']}</td><td>{$comment['staff_name']}</td><td>{$comment['comment']}</td></t></tr>";
            }
        } elseif($comments != null && $comment_rows < 2) {
            if ($comments['type_id'] == 1) $color = '#cccccc';
            if (strripos($comments['comment'], 0x20) === false) {
                $comments['comment'] = mb_substr($comments['comment'], 0, 30) . '...';
            }
            echo "<tr bgcolor='$color'><td>{$comments['now_date']}</td><td>{$comments['staff_name']}</td><td>{$comments['comment']}</td></t></tr>";
        }
        ?>
        <tr>
            <td colspan='3' id='td_color'>Комментарий</td>
        </tr>
        <tr>
            <td colspan='3'><textarea <? echo $access; ?> name='comment2' required></textarea></td>
        </tr>
        <tr>
            <td colspan='3'><input <? echo $access; ?> value='Отправить' type='submit'></td>
        </tr>
    </table>
</form>
</form>