<?php
require 'vendor/autoload.php'; // Certifique-se de que o caminho está correto

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include_once('conf.php');

// Limpa qualquer saída que possa ter sido enviada antes
if (ob_get_length()) ob_end_clean();

// Cria uma nova planilha
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Alunos');

// Define o cabeçalho
$sheet->setCellValue('A1', 'Nome');
$sheet->setCellValue('B1', 'Turma');
$sheet->setCellValue('C1', 'Telefone');
$sheet->setCellValue('D1', 'Excel');
$sheet->setCellValue('E1', 'word');
$sheet->setCellValue('F1', 'PowerPoint');
$sheet->setCellValue('G1', 'Lógica');
$sheet->setCellValue('H1', 'Games');
$sheet->setCellValue('I1', 'HTML');

// Obtém os dados do banco de dados
$query = "SELECT * FROM alunos";
$result = mysqli_query($conexao, $query);

$rowNumber = 2;
while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['Nome']);
    $sheet->setCellValue('B' . $rowNumber, $row['Turma']);
    $sheet->setCellValue('C' . $rowNumber, $row['Tel']);
    $sheet->setCellValue('D' . $rowNumber, $row['Excel']);
    $sheet->setCellValue('E' . $rowNumber, $row['word']);
    $sheet->setCellValue('F' . $rowNumber, $row['PowerPoint']);
    $sheet->setCellValue('G' . $rowNumber, $row['Logica']);
    $sheet->setCellValue('H' . $rowNumber, $row['Games']);
    $sheet->setCellValue('I' . $rowNumber, $row['HTML']);
    $rowNumber++;
}

// Gera o arquivo XLSX para download
$writer = new Xlsx($spreadsheet);
$filename = 'alunos.xlsx';

// Limpa qualquer saída pendente
ob_end_clean();

// Cabeçalhos para forçar o download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');
header('Expires: 0');
header('Pragma: public');

// Salva o arquivo na saída do buffer para o download
$writer->save('php://output');
exit();