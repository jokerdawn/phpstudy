<?php
  
/** 
 * @author youthflies
 * 
 * 
 */
class Calendar
{
  
    //TODO - Insert your code here
    private $year;      //��ǰ���
    private $month;     //��ǰ�·�
    private $days;      //��ǰ�·�һ��������
    private $start_weekday;     //��ǰ�·ݵ�һ�����ܼ�
  
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
     * ħ������__toString()������ӡ����
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
     * weekList()���������ڴ�ӡ���б�
     */
    private function weeksList()
    {
        $week = array('��', 'һ', '��', '��', '��', '��', '��');
        $out = '<tr>';
        for($i = 0; $i<=count($week)-1; $i++)
            $out .= '<th class="fontb">' . $week[$i] . '</th>';
        $out .= "</tr>";
        return $out;
    }
      
    /**
     * daysList()�������������б�
     */
    private function daysList()
    {
        $j = 0; //����ÿһ��ֻ���7��
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
            //ͻ����ʾ��ǰ��
            if($i == date("d", time()))
                $out .= '<td bgcolor="blue">' . ($i+1) . '</td>';
            else
                $out .= '<td>' . ($i+1) . '</td>';
            $j++;
        }
        //ʣ���ÿո���
        while($j%7!=0)
        {
            $out .= '<td>' . ' ' .'</td>';
            $j++;
        }
        return $out;
    }
      
    /**
     * prevYear()�����������û������һ��Ķ���
     */
    private function prevYear($year, $month)
    {
        $year--;
        if($year <1970)
            $year = 1970;
        return "year={$year}&month={$month}";
    }
      
    /**
     * prevMonth()�����������û������һ���µĶ���
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
     * �����Ǵ����û������һ���º���һ��Ķ���
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
     * changeDate()����ִ���û�������ݺ��·�
     */
    private function chageDate($url = "Calendar.php")
    {
        //���������ݺ��·ݵĿ�ݼ�
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
echo '<title>���ڿؼ�</title> </head>';
echo '<body>';
        $cal = new Calendar();
        echo $cal;
echo '</body> </html>';
?>