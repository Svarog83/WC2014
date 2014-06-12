<?
header( 'Content-type:application/vnd.ms-excel' );
header( 'Content-Disposition:attachment;filename=bets_' . date( "Y-m-d_H-i" ) . '.xls' );
?>

<html>
<head>
    <meta http-equiv="Last-Modified" content="<? echo gmdate( "D, M d Y H:i:s" ) ?> GMT">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name=ProgId content=Excel.Sheet>
    <meta name=Generator content="Microsoft Excel 9">
    <style type="text/css">
        <!--
        .style0 {
            mso-number-format: General;
            vertical-align: bottom;
            white-space: nowrap;
            color: windowtext;
            font-size: 10.0pt;
            font-weight: 400;
            font-style: normal;
            text-decoration: none;
            font-family: "Arial Cyr", sans-serif;
        }

        .xl35 {
            mso-style-parent: style0;
            font-family: "Arial Unicode MS", sans-serif;
            mso-number-format: "\@";
            white-space: nowrap;
        }

        -->
    </style>
</head>
<body>
<table cellpadding="2" cellspacing="2" border="1" width="100%">
    <tr style="font-weight:bold;">
        <td width="30">No</td>
        <td width="200">Игра</td>
        <td width="100">Результат</td>
        <? foreach ( $PlayersArr AS $user_id => $v ): ?>
        <td colspan="2" width="100"><?= $v['name']?></td>
        <? endforeach; ?>
    </tr>

<? if ( !count( $MatchesArr ) ): ?>
    <tr>
        <td colspan="<?= $colspan?>">Матчей не найдено</td>
    </tr>
<?else : ?>
    <? foreach ( $MatchesArr AS $g_tour => $v ): ?>
        <tr style="font-weight:bold;">
            <td colspan="3">Тур <?php echo $g_tour; ?></td>
        <? foreach ( $PlayersArr AS $user_id => $v1 ): ?>
            <td colspan="2"><?= $g_tour <= $v1['tour'] ? '+' : '-' ?></td>
        <? endforeach; ?>
        </tr>

        <? foreach ( $v AS $g_id => $row ): ?>
                <? $i++ ?>
            <tr>
                <td><?= $i?></td>
                <td><?= $TeamsArr[$row['g_team1']] . '-' . $TeamsArr[$row['g_team2']] ?></td>
                <td>&nbsp;<?= $row['g_result']?></td>
                <? foreach ( $PlayersArr AS $user_id => $v ): ?>

                <td width="50"><?= isset ( $ResultsArr[$g_id][$user_id] ) ? $ResultsArr[$g_id][$user_id]['points'] : '0' ?></td>
                <td width="50" class="xl35">
                <?= isset ( $ResultsArr[$g_id][$user_id]['result'] ) ? $ResultsArr[$g_id][$user_id]['result'] : '' ?>
                    </td>
                <? endforeach; ?>
             </tr>
        <? endforeach; ?>

    <tr style="font-weight:bold; text-align:left;">
        <td colspan="3">Результаты Тура <?= $g_tour?>:</td>
        <? foreach ( $PlayersArr AS $user_id => $v ): ?>
        <td align="left" colspan="2"><?= isset ( $sum_tour[$g_tour][$user_id] ) ? '<b>' . $sum_tour[$g_tour][$user_id] . '</b>' : '0' ?></td>
        <? endforeach; ?>
    </tr>
    <? if ( $g_tour % $setup_beer_tours == 0 ): ?>
         <? $j = ceil( $g_tour / $setup_beer_tours ) ?>
        <tr style="font-weight:bold; font-size: 14pt; text-align:left;">
            <td colspan="3">После <?= $setup_beer_tours?>-х туров:</td>
            <? foreach ( $PlayersArr AS $user_id => $v ): ?>
            <td colspan="2" <?= $sum_for_beer[$j][$user_id] == max( $sum_for_beer[$j] ) ? 'style="color:red;"' : '' ?>><?= isset ( $sum_for_beer[$j][$user_id] ) ? '<b>' . $sum_for_beer[$j][$user_id] . '</b>' : '0' ?></td>
            <? endforeach; ?>
        </tr>
    <? endif; ?>
    <? endforeach; ?>

    <tr style="font-weight:bold; font-size: 16pt; text-align:left;">
        <td colspan="3">TOTAL:</td>
        <? foreach ( $PlayersArr AS $user_id => $v ): ?>
        <td colspan="2"  <?= $sum_total[$user_id] == max( $sum_total ) ? 'style="color:red;"' : '' ?>><?= isset ( $sum_total[$user_id] ) ? $sum_total[$user_id] : '0' ?></td>
        <? endforeach; ?>
    </tr>
<? endif; ?>

</table>

</body>
</html>

