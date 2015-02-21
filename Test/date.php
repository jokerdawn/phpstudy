<?php
  
/** 
 * @author youthflies
 * 
 * 
 */
class Calendar
{
  
    //TODO - Insert your code here
    private $year;      //当前年份
    private $month;     //当前月份
    private $days;      //当前月份一共多少天
    private $start_weekday;     //当前月份第一天是周几
  
    function __construct()
    {
      
        //TODO - Insert your code here
        $this->year = isset($_GET["year"]) ? $_GET["year"] : date("Y");
        $this->month = isset($_GET["month"]) ? $_GET["month"] : date("m");
        $this->start_weekday = date("w", mktime(0, 0, 0, $this->month, 1, $this->year));
        $this->days = date("t", mktime(0, 0, 0, $this->month, 1, $this->year));
          
    }
  
    /**
     * 
     */
    function __destruct()
    {
      
        //TODO - Insert your code here
    }
      
    /**
     * 魔术方法__toString()用来打印日历
     */
    function __toString()
    {
        $out = '<table align="center">';
        $out .= $this->chageDate();
        $out .= $this->weeksList();
        $out .= $this->daysList();
        $out .= '</table>';
        return $out;
    }
      
    /**
     * weekList()函数，用于打印周列表
     */
    private function weeksList()
    {
        $week = array('日', '一', '二', '三', '四', '五', '六');
        $out = '<tr>';
        for($i = 0; $i<=count($week)-1; $i++)
            $out .= '<th class="fontb">' . $week[$i] . '</th>';
        $out .= "</tr>";
        return $out;
    }
      
    /**
     * daysList()函数，输入日列表
     */
    private function daysList()
    {
        $j = 0; //控制每一行只输出7次
        $out = '<tr>';
        for($i = 0; $i<=$this->start_weekday-1; $i++)
        {
            $out .= '<td> &nbsp ' . '</td>';
            $j++;
        }
        for($i=0; $i<=$this->days-1; $i++)
        {
            if ($j%7==0)
                $out .= '</tr><tr>';
            //突出显示当前日
            if($i == date("d", time()))
                $out .= '<td bgcolor="blue">' . ($i+1) . '</td>';
            else
                $out .= '<td>' . ($i+1) . '</td>';
            $j++;
        }
        //剩余用空格补齐
        while($j%7!=0)
        {
            $out .= '<td>' . ' ' .'</td>';
            $j++;
        }
        return $out;
    }
      
    /**
     * prevYear()函数来操作用户点击上一年的动作
     */
    private function prevYear($year, $month)
    {
        $year--;
        if($year <1970)
            $year = 1970;
        return "year={$year}&month={$month}";
    }
      
    /**
     * prevMonth()函数来操作用户点击上一个月的动作
     */
    private function prevMonth($year, $month)
    {
        if($month <= 1)
        {
            $year--;
            if($year<1970)
            {
                $month = 1;
                $year = 1970;
            }
            else
                $month = 12;
        }
        else
            $month--;
        return "year={$year}&month={$month}";
    }
      
    /**
     * 下面是处理用户点击下一个月和下一年的动作
     */
    private function nextYear($year, $month)
    {
        $year++;
        if($year >= 2038)
            $year = 2038;
        return "year={$year}&month={$month}";
    }
    private function nextMonth($year, $month)
    {
        if($month >= 12)
        {
            $year++;
            if($year == 2039)
            {
                $year = 2038;
                $month = 12;
            }
            else
                $month = 1;         
        }
        else
            $month++;
        return "year={$year}&month={$month}";
    }
      
    /**
     * changeDate()函数执行用户调整年份和月份
     */
    private function chageDate($url = "Calendar.php")
    {
        //定义调整年份和月份的快捷键
        $out = '<tr>';
        $out .= '<td><a href="' . $url . '?' . $this->prevYear($this->year, $this->month) . '">' . '<<' . '</a></td>';
        $out .= '<td><a href="' . $url . '?' . $this->prevMonth($this->year, $this->month) . '">' . '<' . '</a></td>';
        $out .= '<td colspan="3">';
        $out .= '<form>';
        $out .= '<select name="year" onchange="window.location='' . $url . '?year='+this.options[selectedIndex].value+'&month=' . $this->month . ''">';
        for($sy=1970; $sy <=2038; $sy++)
        {
            $selected = ($sy==$this->year) ? "selected" : "";
            $out .= '<option ' . $selected . ' value="' . $sy .'">' . $sy . '</option>';
        }
        $out .= '</select>';
        //$out .= '</td>';
        //$out .= '<td colspan="2">';
        $out .= '<select name="month" onchange="window.location='' . $url . '?year=' . $this->year . '&month='+this.options[selectedIndex].value">';
        for($sm=1; $sm<=12; $sm++)
        {
            $selectedMonth = ($sm==$this->month)? "selected" : "";
            $out .= '<option ' . $selectedMonth . ' value="' . $sm . '">' . $sm . '</option>';
        }
        $out .='</select>';
        $out .= '</form>';
        $out .= '</td>';
          
        $out .= '<td><a href="' . $url . '?' . $this->nextYear($this->year, $this->month) . '">' . '>>' . '</a></td>';
        $out .= '<td><a href="' . $url . '?' . $this->nextMonth($this->year, $this->month) . '">' . '>' . '</a></td>';
        $out .= '</tr>';
        return $out;
    }
}
  
  
echo '<html>';
echo '<head>';
echo '<meta http-equiv=Content-Type content="text/html;charset=utf-8">';
echo '<style>
    table { border:1px solid #050;}
    .fontb { color:wihte; background:blue; }
    th {    width:35px; }
    td, th  {   width: 40px; height:30px; text-aligh:center;    }
    form    { margin:0px; padding:0px;  }
    </style>';
echo '<title>日期控件</title> </head>';
echo '<body>';
        $cal = new Calendar();
        echo $cal;
echo '</body> </html>';
?>