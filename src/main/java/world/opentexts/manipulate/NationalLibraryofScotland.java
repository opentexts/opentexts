/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package world.opentexts.manipulate;

import java.io.BufferedWriter;
import java.io.FileReader;
import java.io.Reader;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.Arrays;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVPrinter;
import org.apache.commons.csv.CSVRecord;
import world.opentexts.validate.Validator;

/**
 * A manipulation tool to convert NLS data feeds into the OpenTexts.World CSV format
 * 
 * @author Stuart Lewis
 */
public class NationalLibraryofScotland {
    
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
            Reader in = new FileReader(inFilename);

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
 
            // Process each line
            for (CSVRecord record : CSVFormat.DEFAULT.parse(in)) {
                if (!header) {
                    System.out.println(" - Processing header");
                    header = true;
                } else {
                    organisation = "National Library of Scotland";

                    idLocal = record.get(1);

                    title = record.get(2);
                    if (title.endsWith("=")) title = title.substring(0, title.length() - 1);
                    if (title.endsWith(":")) title = title.substring(0, title.length() - 1);
                    if (title.endsWith("/")) title = title.substring(0, title.length() - 1);
                    title = title.strip();

                    // Select the last URL if there are multiple
                    urlMain = record.get(3);
                    if (urlMain.contains("|")) {
                        String[] values = urlMain.split("\\|");
                        //System.out.println(values[0] + " - " + values[1]);
                        urlMain = values[values.length - 1].strip();
                    }

                    // Select the first year if there are multiple
                    year = record.get(4);
                    if (year.contains("|")) {
                        String[] values = year.split("\\|");
                        year = values[0].strip();
                    }

                    publisher = record.get(5);    

                    creator = record.get(6);

                    topic = record.get(7);

                    description = record.get(8);

                    // Select the last URL if there are multiple
                    urlPDF = record.get(9);
                    if (urlPDF.contains("|")) {
                        String[] values = urlPDF.split("\\|");
                        urlPDF = values[values.length - 1].strip();
                    }

                    // Select the last URL if there are multiple
                    urlOther = record.get(10);
                    if (urlOther.contains("|")) {
                        String[] values = urlOther.split("\\|");
                        urlOther = values[values.length - 1].strip();
                    }

                    // Select the last URL if there are multiple
                    urlIIIF = record.get(11);
                    if (urlIIIF.contains("|")) {
                        String[] values = urlIIIF.split("\\|");
                        urlIIIF = values[values.length - 1].strip();
                    }

                    placeOfPublication = record.get(12);

                    // Select the first licence if there are multiple
                    licence = record.get(13);
                    if (licence.contains("|")) {
                        String[] values = licence.split("\\|");
                        licence = values[0].strip();
                    }

                    idOther = record.get(14);

                    // Generate the catalogue link
                    catLink = "https://search.nls.uk/primo-explore/search?vid=44NLS_VU1&query=any,contains," + idLocal;
                    
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
        }
    }
}
