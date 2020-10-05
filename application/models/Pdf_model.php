<?php

class Pdf_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Pdf");
    }
    public function printmeasurement($data)
    {
        $pdf = new PDF();
        // pr($data);exit;
        $pdf->AddPage();
        $title = 'Measurements';
        $pdf->SetTitle($title);

        $txt = 'Measurements';
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Text(95, 10, $txt, 'C');
        $pdf->SetXY(5, 15);
        $txt = 'Name:';
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(16, 8, $txt, 0, 0, '');

        $name = strtoupper($data['customerdetails']['name']);
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(45, 8, $name, 0, 1, 'L');

        // $pdf->SetXY(75,15);
        // $txt = 'Phone number:';
        // $pdf->SetFont('Arial','B',13);
        // $pdf->Cell(40,8,$txt,0,0,'');

        // $phone = $data['customerdetails']['mobile_no'];
        // $pdf->SetFont('Arial','',13);
        // $pdf->Cell(40,8,$phone,0,1,'C');

        $pdf->SetXY(5, 30);
        $txt = 'Sr No';
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(15, 8, $txt, "B,L,T", 0, '');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(45, 8, 'Title', 1, 0, 'C');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(110, 8, 'Description', 1, 0, 'C');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(30, 8, 'Order No', 1, 0, 'C');
        //$pdf = new PDF();

        // $pdf->AddPage();

        // $pdf->SetXY(10,5);

        // $pdf->SetLineWidth(0.5);

        // $pdf->Cell(190,10,'',0,1,'C');

        // // $pdf->Line(200,15,15,15);

        // $pdf->Ln(7);

        // $pdf->SetX(25);

        // $pdf->SetFont('Arial','B',14);
        // $txt = 'Tailor App';
        // $pdf->Cell(160,8,$txt,1,1,'C');

        // $pdf->SetXY(35,20);

        // $txt = 'Name:';
        // $pdf->SetFont('Arial','B',13);
        // $pdf->Cell(15,10,$txt,"T,L B",0,'');

        // $pdf->SetFont('Arial','',13);
        // $pdf->Cell(145,10, $data['customerdetails']['name'],"R,T,B",1,'');

        // $pdf->SetXY(35,30);
        // $txt = 'Phone Number:';
        // $pdf->SetFont('Arial','B',13);
        // $pdf->Cell(40,10,$txt,"L,B",0,'');

        // $pdf->SetFont('Arial','',13);
        // $pdf->Cell(65,10,$data['customerdetails']['mobile_no'],'B',0,'');

        $xyz = 38;
        $height = 8;
        $i = 1;
        foreach ($data['data'] as $data) {
            $pdf->SetXY(5, $xyz);
            $pdf->SetFont('Arial', '', 12);
            $title = $data['title'];
            $description = trim($data['description']);
            $description = trim(preg_replace('/\s\s+/', ', ', $description));
            // pr($description);exit;
            // $pdf->MultiCell(50,8,$title,"T,B,L,R",'C');
            // $description = trim($data['description']);

            $multiple2 = ceil(strlen($description) / 70);
            $x = ($height * $multiple2);

            $xyz += $x;

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(15, $x, $i, "T,L B", 0, 'C');

            $pdf->Cell(45, $x, $title, "T,B,L,R", 0, 'C');

            $pdf->SetX(175);
            $pdf->Cell(30, $x, $data['order_number'], "T,B,L,R", 0, 'C');

            $pdf->SetX(65);
            $pdf->SetFont('Arial', '', 12);
            // $description = trim($data['description']);
            $pdf->MultiCell(110, 8, $description, "T,B,L,R", 'C');

            $i++;

        }
        $pdf->Output();
    }

    public function printInvoice($data)
    {
        $data = $data['order'];
        $pdf = new PDF();
        $pdf->AddPage();
        $title = 'Invoice';
        $pdf->SetTitle($title);
        $pdf->SetXY(10, 5);
        $pdf->SetLineWidth(0.6);
        $pdf->Cell(190, 10, '', 0, 1, 'C');

        $pdf->Ln(7);

        $pdf->SetX(25);

        $pdf->SetFont('Arial', 'B', 17);
        $txt = '';
        $pdf->Cell(35, 12, $txt, 'T', 0, 'C');

        $txt = 'Fashion Makers';
        $pdf->Cell(90, 12, $txt, 'T', 0, 'C');

        $pdf->SetFont('Arial', 'B', 13);
        $txt = 'Bill No:';
        $pdf->Cell(16, 12, $txt, 'T', 0, 'C');

        $pdf->SetFont('Arial', '', 13);
        $txt = $data['id'];
        $pdf->Cell(19, 12, $txt, 'T', 1, 'L');

        $pdf->Line(90, 32, 120, 32);

        $pdf->SetX(25);

        $txt = 'Name:';
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(18, 10, $txt, "L", 0, 'C');

        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(142, 10, strtoupper($data['customer_name']['name']), "R", 1, '');

        $pdf->SetX(25);
        $txt = 'Phone:';
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(20, 10, $txt, "L,B", 0, 'C');

        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(80, 10, $data['customer_name']['mobile_no'], 'B', 0, '');

        $txt = 'Date:';
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(14, 10, $txt, 'B', 0, '');

        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(46, 10, $data['delivery_date'], ",RB", 1, '');

        $pdf->SetX(25);

        $pdf->SetX(25);

        $txt = 'Sr No';
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(16, 8, $txt, 1, 0, '');

        $pdf->Cell(79, 8, 'Praticular', 1, 0, 'C');

        $pdf->Cell(25, 8, 'Quantity', "B,R,T", 0, 'C');

        $pdf->Cell(40, 8, 'Amount', "B,R,T", 1, 'C');

        $y = 70;
        $j = 0;
        $i = 1;

        foreach ($data['product'] as $data1) {
            $pdf->SetX(25);
            $cut = strripos(trim($data1), ' ');

            $bdtext1 = substr($data1, 0, $cut);
            $bdtext2 = substr($data1, $cut);

            $cut1 = strrpos(trim($bdtext1), '(');
            $quan = substr($bdtext1, $cut1 + 1);
            $particular = substr($bdtext1, 0, $cut1);

            $cut2 = strrpos(trim($quan), ')');
            $quan2 = substr($quan, 0, $cut2);

            $txt = $i;
            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(16, 8, $txt, "L", 0, 'C');

            $name = explode(' ', $data1);

            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(79, 8, ' ' . $particular, "L,R", 0, 'L');

            $j += $quan2;

            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(25, 8, $quan2, "R", 0, 'C');

            $pdf->SetFont('Arial', '', 13);
            $pdf->Cell(40, 8, $bdtext2, "R", 1, 'C');

            $i++;
            $y += 8;

        }

        // $pdf->SetX(25);
        // $pdf->Cell(160,80,'','LR',1,'C');

        $pdf->SetXY(25, 165);
        $txt = '';
        $pdf->SetFont('Arial', '', 13);
        $pdf->Cell(16, 8, $txt, 1, 0, 'C');

        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(79, 8, 'Total', 1, 0, 'C');

        $pdf->Cell(25, 8, $j, 1, 0, 'C');

        $pdf->Cell(40, 8, $data['total_cost'], 1, 0, 'C');

        $pdf->Line(25, 22, 25, 166);

        $pdf->Line(41, 55, 41, 166);

        $pdf->Line(120, 55, 120, 166);

        $pdf->Line(145, 55, 145, 166);

        $pdf->Line(185, 22, 185, 166);

        $pdf->Output();

    }

    public function printdashboardorders($data)
    {
        // pr($data);exit;

        $pdf = new PDF();
        $pdf->AddPage();
        $title = 'Orders';
        $pdf->SetTitle($title);
        $pdf->SetXY(10, 5);
        $pdf->SetX(10);

        $txt = 'Orders';
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Text(95, 10, $txt, 'C');

        $pdf->SetY(15);

        $txt = 'Sr No';
        $pdf->SetFont('Arial', 'B', 13);
        $pdf->Cell(15, 8, $txt, 1, 0, '');

        $pdf->Cell(45, 8, 'Name', 1, 0, 'C');

        $pdf->Cell(30, 8, 'Delivery Date', "B,R,T", 0, 'C');

        $pdf->Cell(75, 8, 'Products', "B,R,T", 0, 'C');
        $pdf->Cell(30, 8, 'Cost', "B,R,T", 1, 'C');

        $xyz = 38;
        $height = 8;
        $i = 1;
        foreach ($data as $data) {

            $pdf->SetFont('Arial', '', 12);

            $strlen = strlen($data['customer_name']['name']);
            if ($strlen > 22) {
                $str = strtok($data['customer_name']['name'], " ");
                $title = ucfirst($str);
            } else {
                $title = ucfirst($data['customer_name']['name']);
            }
            // pr($strlen);exit;
            // strtok($value, " ");
            $product_name = trim($data['product_name']);
            $product_name = trim(preg_replace('/\s\s+/', ', ', $product_name));

            $multiple2 = ceil(strlen($product_name) / 30);
            $x = ($height * $multiple2);
            // pr($x);
            $xyz += $x;

            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(15, $x, $i, "T,B,L,R", 0, 'C');

            $pdf->Cell(45, $x, $title, "T,B,L", 0, 'C');
            // $pdf->SetX(60);
            $pdf->Cell(30, $x, $data['delivery_date'], "T,B,L,R", 0, 'C');
            $pdf->SetX(175);
            $pdf->Cell(30, $x, $data['total_cost'], "T,B,L,R", 0, 'C');

            $pdf->SetX(100);
            $pdf->SetFont('Arial', '', 12);
            // $description = trim($data['description']);
            $pdf->MultiCell(75, 8, $product_name, "T,B", 'C');

            $i++;

        }
        // exit;
        $pdf->Output();

    }

}
