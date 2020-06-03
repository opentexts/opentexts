/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package world.opentexts.manipulate;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileInputStream;
import java.io.InputStreamReader;
import java.io.Reader;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.Arrays;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVParser;
import org.apache.commons.csv.CSVPrinter;
import org.apache.commons.csv.CSVRecord;
import world.opentexts.validate.Validator;

/**
 * A manipulation tool to convert NLW data feeds into the OpenTexts.World CSV format
 * 
 * @author Stuart Lewis
 */
public class NationalLibraryOfWalesMARCXML {

    public static void main(String[] args) {
        // Take the filename in and out as the only parameters
        if (args.length < 2) {
            System.err.println("Please supply input and output filenames");
            System.exit(0);
        }

        try {
            // Open the input CSV
            String inFilename = args[0];
            System.out.println("Cleaning file: " + inFilename);
            //Reader in = new FileReader(inFilename, "UTF-8");
            Reader in = new BufferedReader(new InputStreamReader(new FileInputStream(inFilename), "UTF-8"));

            // Open the output CSV
            String outFilename = args[1];
            BufferedWriter writer = Files.newBufferedWriter(Paths.get(outFilename));
            CSVPrinter csvPrinter = new CSVPrinter(writer, CSVFormat.DEFAULT.withHeader(
                                                    "organisation",
                                                    "idLocal",
                                                    "title",
                                                    "urlMain",
                                                    "year",
                                                    "publisher",
                                                    "creator",
                                                    "topic",
                                                    "description",
                                                    "urlPDF",
                                                    "urlOther",
                                                    "urlIIIF",
                                                    "placeOfPublication",
                                                    "licence",
                                                    "idOther",
                                                    "catLink"));
            
            // Setup some variables
            boolean header = false;
            int lineCounter = 1;
            String organisation = "", idLocal = "", title = "", urlMain = "", year = "",
                   publisher = "", creator = "", topic = "", description = "", urlPDF = "", 
                   urlOther = "", urlIIIF = "", placeOfPublication = "", licence = "", idOther = "",
                   catLink = "";
 
            CSVParser csvParser = new CSVParser(in, CSVFormat.DEFAULT
                    .withHeader("RecordID", "DateAdded", "DateChanged", "Author", "Title", "CopyrightDate", 
                                "Barcode", "Classification", "MainEntry", "Custom1", "Custom2", "Custom3", 
                                "Custom4", "Custom5", "ImportErrors", "ValidationErrors", "TagNumber", "Ind1", 
                                "Ind2", "ControlData", "Sort", "LDR", "001", "005", "006", "007", "008", "010", 
                                "016", "019", "024", "020", "029", "035", "022", "038", "240", "250", "059", 
                                "080", "084", "111", "048", "264", "041", "042", "243", "490", "655", "043", 
                                "100", "039", "069", "336", "505", "040", "337", "440", "130", "245", "338", 
                                "563", "752", "776", "830", "082", "246", "504", "561", "110", "260", "321", 
                                "534", "581", "600", "050", "300", "509", "720", "310", "362", "730", "500", 
                                "515", "546", "510", "520", "588", "540", "939", "522", "533", "539", "611", 
                                "777", "210", "525", "550", "780", "222", "630", "935", "941", "580", "555", 
                                "610", "740", "775", "650", "936", "981", "651", "711", "700", "710", "583", 
                                "785", "886", "940", "856", "912", "978", "850", "999")
                    .withIgnoreHeaderCase()
                    .withTrim());
            
            // Process each line
            int counter = 0;
            for (CSVRecord record : csvParser) {
                counter++;
                if (true) {
                    System.out.println(" - Line: " + counter);
                }
                if (!header) {
                    System.out.println(" - Processing header");
                    header = true;
                } else {
                    organisation = "National Library of Wales";

                    idLocal = record.get("001");

                    //"$aThe works of Mr. Thomas Brown, in prose and verse :$bserious, moral, and comical /$cTo which is prefix'd, A character of Mr. Tho. Brown and his writings, by James Drake"
                    title = record.get("245");
                    title = title.replaceAll("\\$", "d0llar");
                    title = title.substring(7);
                    if (title.contains("d0llarb")) {
                        title = title.replace(":d0llarb", "");
                    }
                    if (title.contains("d0llarc")) {
                        title = title.replace("/d0llarc", "");
                    }
                    
                    // $3(t.13(1865))$uhttp://purl.ox.ac.uk/uuid/7a8e629e39b5417aa410cb5687d9f69a$3(t.14(1865))$uhttp://purl.ox.ac.uk/uuid/1c6220f6e8254ced8f51ab2a2ae4fe28
                    // Select the last URL if there are multiple
                    urlMain = record.get("856");
                    urlMain = urlMain.replaceAll("\\$", "d0llar");
                    urlMain = urlMain.substring(urlMain.indexOf("d0llaru") + 7);
                    if (urlMain.contains("d0llar")) {
                        urlMain = urlMain.substring(0, urlMain.indexOf("d0llar"));
                    }
                    
                    // Select the first year if there are multiple
                    year = record.get("CopyrightDate");

                    // Publisher 260 $b
                    publisher = record.get("260");
                    if (!"".equals(publisher)) {
                        publisher = publisher.replaceAll("\\$", "d0llar");
                        publisher = publisher.substring(publisher.indexOf("d0llarb") + 7);
                        if (publisher.contains("d0llar")) {
                            publisher = publisher.substring(0, publisher.indexOf("d0llar")).strip();
                        }
                    }
                    String twoSixFour = record.get("264");
                    if (!"".equals(twoSixFour)) {
                        twoSixFour = twoSixFour.replaceAll("\\$", "d0llar");
                        twoSixFour = twoSixFour.substring(twoSixFour.indexOf("d0llarb") + 7);
                        twoSixFour = twoSixFour.substring(0, twoSixFour.indexOf("d0llarc"));
                        publisher = publisher + twoSixFour.replaceAll("d0llarc", "").strip();   
                    }

                    creator = record.get("100");
                    if (!"".equals(creator)) {
                        creator = creator.replaceAll("\\$", "d0llar");
                        creator = creator.substring(creator.indexOf("d0llara") + 7);
                        if (creator.contains("d0llar")) creator = creator.substring(0, creator.indexOf("d0llar")).strip();
                    }
                    
                    topic = record.get("610");
                    if (!"".equals(topic)) {
                        topic = topic.replaceAll("\\$", "d0llar");
                        topic = topic.substring(topic.indexOf("d0llara") + 7);
                        if (topic.contains("d0llar")) topic = topic.substring(0, topic.indexOf("d0llar")).strip();
                    }

                    description = record.get("500");
                    if (!"".equals(description)) {
                        description = description.replaceAll("\\$a", "|").substring(1);
                    }

                    // Select the last URL if there are multiple
                    urlPDF = "";

                    // Select the last URL if there are multiple
                    urlOther = "";

                    // Select the last URL if there are multiple
                    urlIIIF = "";

                    placeOfPublication = record.get("260");    
                    if (!"".equals(placeOfPublication)) {
                        placeOfPublication = placeOfPublication.replaceAll("\\$", "d0llar");
                        placeOfPublication = placeOfPublication.substring(placeOfPublication.indexOf("d0llara") + 7);
                        if (placeOfPublication.contains("d0llar")) placeOfPublication = placeOfPublication.substring(0, placeOfPublication.indexOf("d0llar")).strip();
                        if (placeOfPublication.endsWith(" :")) placeOfPublication = placeOfPublication.substring(0, placeOfPublication.length() - 2);
                    }
                    twoSixFour = record.get("264");
                    if (!"".equals(twoSixFour)) {
                        twoSixFour = twoSixFour.replaceAll("\\$", "d0llar");
                        twoSixFour = twoSixFour.substring(twoSixFour.indexOf("d0llara") + 7);
                        twoSixFour = twoSixFour.substring(0, twoSixFour.indexOf(":d0llarb"));
                        placeOfPublication = placeOfPublication + twoSixFour.replaceAll("d0llarc", "").strip();   
                    }

                    // Select the first licence if there are multiple
                    licence = "";

                    idOther = "";
                    
                    // Generate the catalogue link
                    catLink = "https://discover.library.wales/primo-explore/search?vid=44WHELF_NLW_NUI&query=any,contains," + idLocal ;

                    //System.out.println(idLocal);
                    csvPrinter.printRecord(Arrays.asList(organisation, idLocal, title,
                                                         urlMain, year, publisher,
                                                         creator, topic, description,
                                                         urlPDF, urlOther, urlIIIF,
                                                         placeOfPublication, licence, idOther,
                                                         catLink));
                }
            }
            System.out.println("Writing file: " + outFilename);
            csvPrinter.flush();
            csvPrinter.close();
            
            // Run the validator
            Validator v = new Validator(outFilename);
        } catch (Exception e) {
            System.err.println("ERROR - " + e.getMessage());
            e.printStackTrace();
        }
    }
}
