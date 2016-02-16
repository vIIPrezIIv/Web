<?php

require_once("asst1Include.php");

function setUpForm($buttons)
{
	WriteHeaders("Music, Real Ortelli", "Music");
	
	echo "<div class = \"bigpiece\">";
	
		echo "<form action = \"?\" method=\"POST\">";
	
			echo "<div class = \"leftpiece\">";

				if(strpbrk("$buttons", "S"))
				{
					DisplayButton("button", "Save", "", "Save", "save");
				}
				
				if(strpbrk("$buttons", "H"))
				{
					DisplayButton("button", "Home", "", "Home", "home");
				}
				
				if(strpbrk("$buttons", "A"))
				{
					DisplayButton("button", "Add Record", "", "Add Record" , "addRecord");
				}
				
				if(strpbrk("$buttons", "C"))
				{
					DisplayButton("button", "Create Table", "", "Create Table", "createTable");
				}
				
				if(strpbrk("$buttons", "M"))
				{
					DisplayButton("button", "Modify Record", "", "Modify Record", "modifyRecord");
				}
				
				if(strpbrk("$buttons", "D"))
				{
					DisplayButton("button", "Display Data", "", "Display Data", "displayData");
				}
				
				if(strpbrk("$buttons", "F"))
				{
					DisplayButton("button", "Find Record", "", "Find Record", "findRecord");
				}
				
				if(strpbrk("$buttons", "K"))
				{
					DisplayButton("button", "Save Changes", "", "Save Changes", "saveChanges");
				}
			
			echo "</div>";
		
			echo "<div class = \"middlepiece\">";
}

function finishForm()
{
			echo "</div>";
			
		echo "</form>";
			
			echo "<div class = \"rightpiece\">";
				
				echo "<div class = \"image\">";
			
					DisplayImage("images\musicNote.png", "Music Note", "100px", "100px");
					
				echo "</div>";
			
			echo "</div>";

	echo "</div>";
	
	WriteFooters();
}

function DisplayMainForm()
{
	setUpForm("ACMD");
	
	echo "<p>Welcome To My Page</p>";
	
	finishForm();
}

function DataEntryForm()
{
	setUpForm("SH");
	
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Band Name");
		DisplayTextBox("bandName", "", "");	
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Number of CD's Sold");
		DisplayTextBox("numberOfCdSold", "", "");
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("CD Selling Price");
		DisplayTextBox("cdSellingPrice", "", "");
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Manager Fee ");
		DisplayLabel("45%");
		echo "<input type=\"radio\" name=\"managerFee\" value=\"fortyFive\"/>";
		DisplayLabel("55%");
		echo "<input type=\"radio\" name=\"managerFee\" value=\"fiftyFive\"/>";
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Recording Studio");
		echo "<select name = \"recordStudio\">
				<option value=\"\">N/A</option>
				<option value=\"five\">Rock Rules Recording Studio</option>
				<option value=\"ten\">Sing To Me Studios</option>
				<option value=\"fifteen\">Make Some Noise Studios</option>
			 </select>";
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Advance");
		echo "<input type=\"checkbox\" name=\"checkBox\"/>";
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Distributor Fees");
		DisplayTextBox("distFees", "", "");
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Manufacturing Costs");
		DisplayTextBox("manuCosts", "", "");
		echo "</p>";
		
		echo "<p class=\"paraSpace\">";
		DisplayLabel("Gig Date (YYYY/MM/DD)");
		DisplayTextBox("gigDate", "", "");
		echo "</p>";
	
	finishForm();
}

function ResultsForm()
{
	$revenue = 0;
	$expenses = 0;
	$managementFees = 0;
	$recordingStudioFees = 0;
	$recordingValue = 0;
	$managerPercent = 0;
	$netIncome = 0;
	$advance = 0;
	
	switch($_POST["recordStudio"])
	{
		case "five":
			$recordingValue = 0.05;
			break;
		case "ten":
			$recordingValue = 0.10;
			break;
		case "fifteen":
			$recordingValue = 0.15;
			break;
	}
	
	switch(isset($_POST["managerFee"]))
	{
		case "fortyFive":
			$managerPercent = 0.45;
			break;
		case "fiftyFive":
			$managerPercent = 0.55;
			break;
	}
	
	if($_POST["bandName"] == "")
	{
		$_POST["bandName"] = "N/A";
	}
	
	if($_POST["gigDate"] == "")
	{
		$_POST["gigDate"] = "N/A";
	}
	
	if(isset($_POST["checkBox"]))
	{
		$advance = 1000;
	}
	
	$revenue = $_POST["cdSellingPrice"] * $_POST["numberOfCdSold"];
	
	$managementFees = $managerPercent * $revenue;
	
	$recordingStudioFees = $recordingValue * $revenue;
	
	$expenses = $recordingStudioFees + $managementFees + $advance + $_POST["distFees"]
				+ $_POST["manuCosts"];
				
	$netIncome = $revenue - $expenses;
	
	setUpForm("H");
		
		echo "<div class=\"whiteSpace\">";
		
			echo "<p>
	Breakdown of Revenue
	Number of CD's Sold: ".$_POST["numberOfCdSold"]."
	CD Purchase Price: ".$_POST["cdSellingPrice"]."
	Total Revenue: $".number_format($revenue, 2, ".", ",")."
			   
			
	Breakdown of Expenses
	Management Fees: ".$managementFees."
	Recording Cost: ".$recordingStudioFees."
	Advance: ".$advance."
	Distributor Fees: ".$_POST["distFees"]."
	Manufacturing Costs: ".$_POST["manuCosts"]."
		Total Expenses: $".number_format($expenses, 2, ".", ",")."
	
	".$_POST["bandName"]."'s Net Income is $".number_format($netIncome, 2, ".", ",").". Next gig is ".$_POST["gigDate"]." 
			</p>";
					
		echo "</div>";
	
	finishForm();
}

function ShowFoundRecord()
{
	setUpForm("HK");
	finishForm();
}

function CreateTableForm()
{
	setUpForm("H");
	finishForm();
}

function WriteFoundRecordData()
{
	setUpForm("H");
	finishForm();
}

function ModifyRecord()
{
	setUpForm("HF");
	finishForm();
}

function DisplayData()
{
	setUpForm("H");
	finishForm();
}

//Main
if (!isset($_POST["button"]) OR ($_POST["button"]) == "home" ) 
    DisplayMainForm();
else if ($_POST["button"] == "save") 
	ResultsForm();
else if ($_POST["button"] == "createTable") 
	CreateTableForm();
else if ($_POST["button"] == "addRecord") 
	DataEntryForm();
else if ($_POST["button"] == "findRecord") 
	ShowFoundRecord();
else if ($_POST["button"] == "modifyRecord") 
	ModifyRecord();
else if ($_POST["button"] == "displayData") 
	DisplayData();
else if ($_POST["button"] == "saveChanges") 
	WriteFoundRecordData();

?>