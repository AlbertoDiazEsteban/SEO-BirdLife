<?php
use PHPUnit\Framework\TestCase;
use App\Entity\Presupuesto;
use App\Entity\Years;

class PresupuestoTest extends TestCase
{
    public function testGetAndSetIngresos()
    {
        $presupuesto = new Presupuesto();
        $ingresos = 1000.0;

        $presupuesto->setIngresos($ingresos);
        $this->assertEquals($ingresos, $presupuesto->getIngresos());
    }

    public function testGetAndSetGastos()
    {
        $presupuesto = new Presupuesto();
        $gastos = 800.0;

        $presupuesto->setGastos($gastos);
        $this->assertEquals($gastos, $presupuesto->getGastos());
    }

    public function testGetAndSetFkYear()
    {
        $presupuesto = new Presupuesto();
        $year = new Years();

        $presupuesto->setFkYear($year);
        $this->assertEquals($year, $presupuesto->getFkYear());
    }

    public function testGetId()
    {
        $presupuesto = new Presupuesto();

        // El ID debería ser nulo inicialmente
        $this->assertNull($presupuesto->getId());

        // Simulamos la asignación de un ID
        $reflectionClass = new \ReflectionClass($presupuesto);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($presupuesto, 1);

        // Comprobamos que el ID se ha establecido correctamente
        $this->assertEquals(1, $presupuesto->getId());
    }
}
