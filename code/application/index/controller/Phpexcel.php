<?php
// +----------------------------------------------------------------------+
// | CYCMS                                                                |
// +----------------------------------------------------------------------+
// | Copyright (c) 2016 http://beneng.com All rights reserved.            |
// +----------------------------------------------------------------------+
// | Authors: SpringYang [ceroot@163.com]                                 |
// +----------------------------------------------------------------------+
/**
 * @filename
 * @authors   SpringYang
 * @email     ceroot@163.com
 * @QQ        525566309
 * @date      2016-06-20 10:25:53
 * @site      http://www.benweng.com
 */
namespace app\index\controller;

use think\Controller;

//use third\PHPExcel\PHPExcel;

class Phpexcel extends Controller
{

    public function index()
    {
        $name = 'Excel';
        Vendor('PHPExcel.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator("转弯的阳光")
            ->setLastModifiedBy("转弯的阳光")
            ->setTitle("数据EXCEL导出")
            ->setSubject("数据EXCEL导出")
            ->setDescription("备份数据")
            ->setKeywords("excel")
            ->setCategory("result file");
        $data = array(
            array('username' => 'zhangsan', 'password' => "123456"),
            array('username' => 'lisi', 'password' => "abcdefg"),
            array('username' => 'wangwu', 'password' => "111111"),
        );
        foreach ($data as $key => $value) {
            $num = $key + 1;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $num, $value['username'])
                ->setCellValue('B' . $num, $value['password']);
        }

        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setTitle('User');
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $name . '.xls"');
        header('Cache-Control: max-age=0');
        return PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // $objWriter->save('php://output');
        // exit;

// foreach($data as $k => $v){
        //              $num=$k+1;
        //              $objPHPExcel->setActiveSheetIndex(0)
        //                          //Excel的第A列，uid是你查出数组的键值，下面以此类推
        //                           ->setCellValue('A'.$num, $v['uid'])
        //                           ->setCellValue('B'.$num, $v['email'])
        //                           ->setCellValue('C'.$num, $v['password'])
        //             };
        die;
        return $this->fetch();

    }

    public function exportExcel($expTitle, $expCellName, $expTableData)
    {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle); //文件名称
        $fileName = date('_YmdHis'); //or $xlsTitle 文件名称可根据自己情况设定
        $cellNum  = count($expCellName);
        $dataNum  = count($expTableData);
        vendor("PHPExcel.PHPExcel");

        $objPHPExcel = new \PHPExcel();
        $cellName    = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1'); //合并单元格
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        for ($i = 0; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
        }

        // Miscellaneous glyphs, UTF-8
        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls"); //attachment新窗口打印inline本窗口打印

        Vendor("PHPExcel.PHPExcel.IOFactory");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        dump($expTableData);die;
        $objWriter->save('php://output');
        exit;
    }
/**
 *
 * 导出Excel
 */
    public function expUser()
    {
//导出Excel
        $xlsName = "User";
        $xlsCell = array(
            array('id', '账号序列'),
            array('truename', '名字'),
            array('sex', '性别'),
            array('res_id', '院系'),
            array('sp_id', '专业'),
            array('class', '班级'),
            array('year', '毕业时间'),
            array('city', '所在地'),
            array('company', '单位'),
            array('zhicheng', '职称'),
            array('zhiwu', '职务'),
            array('jibie', '级别'),
            array('tel', '电话'),
            array('qq', 'qq'),
            array('email', '邮箱'),
            array('honor', '荣誉'),
            array('remark', '备注'),
        );
        $xlsModel = db('mem');

        $xlsData = $xlsModel->select();
        // dump($xlsData);
        // die;
        foreach ($xlsData as $k => $v) {
            $xlsData[$k]['sex'] = $v['sex'] == 1 ? '男' : '女';
        }
        // dump($xlsData);die;
        $this->exportExcel($xlsName, $xlsCell, $xlsData);

    }

    private function getExcel($fileName, $headArr, $data)
    {
        $headArr = array("用户名", "密码");
        //对数据进行检验
        if (empty($data) || !is_array($data)) {
            die("data must be a array");
        }
        //检查文件名
        if (empty($fileName)) {
            exit;
        }

        $date = date("Y_m_d", time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $objProps    = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        foreach ($headArr as $v) {
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
            $key += 1;
        }

        $column      = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach ($data as $key => $rows) {
            //行写入
            $span = ord("A");
            foreach ($rows as $keyName => $value) {
// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j . $column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        // $objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }

    public function ddd()
    {
        $data = array(
            array('username' => 'zhangsan', 'password' => "123456"),
            array('username' => 'lisi', 'password' => "abcdefg"),
            array('username' => 'wangwu', 'password' => "111111"),
        );

        $filename = "test_excel";
        $headArr  = array("用户名", "密码");

        $date     = date("Y_m_d", time());
        $fileName = 'test' . "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $objProps    = $objPHPExcel->getProperties();

        //设置表头
        $key = ord("A");
        foreach ($headArr as $v) {
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
            $key += 1;
        }

        $column      = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        foreach ($data as $key => $rows) {
            //行写入
            $span = ord("A");
            foreach ($rows as $keyName => $value) {
// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j . $column, $value);
                $span++;
            }
            $column++;
        }

        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        // $objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        dump($objWriter);die;
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;

    }
}
