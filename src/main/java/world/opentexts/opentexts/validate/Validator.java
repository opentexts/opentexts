/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package world.opentexts.opentexts.validate;

import java.io.FileReader;
import java.io.Reader;
import java.util.ArrayList;
import org.apache.commons.csv.CSVFormat;
import org.apache.commons.csv.CSVRecord;

/**
 * Validate an import file against the OpenTexts.World specification
 * 
 * @author Stuart Lewis
 * 
 * @see <a href="https://opentexts.world/contribute">https://opentexts.world/contribute</a>>
 */
public class Validator {
    
    public Validator(String filename) throws Exception {
        // Open the CSV
        System.out.println("Validating file: " + filename + "\n");
        Reader in = new FileReader(filename);
        
        // Setup some variables
        boolean header = true;
        ArrayList<String> headings = new ArrayList<String>();
        String org = null;
        int lineCounter = 1;
        
        // Process each line
        for (CSVRecord record : CSVFormat.DEFAULT.parse(in)) {
            // First, skip the header if needed
            if (header) {
                header = false;
                // Store the headings
                for (String field : record) {
                    headings.add(field);
                    System.out.println(" - Adding heading (" + headings.size() + "): " + field);
                
                    // Check the headings
                    String expected = "";
                    switch(headings.size()) {
                        case 1: expected = "organisation";
                                break;
                        case 2: expected = "idLocal";
                                break;
                        case 3: expected = "title";
                                break;
                        case 4: expected = "urlMain";
                                break;
                        case 5: expected = "year";
                                break;
                        case 6: expected = "publisher";
                                break;
                        case 7: expected = "creator";
                                break;
                        case 8: expected = "topic";
                                break;
                        case 9: expected = "description";
                                break;
                        case 10: expected = "urlPDF";
                                break;
                        case 11: expected = "urlOther";
                                break;
                        case 12: expected = "urlIIIF";
                                break;
                        case 13: expected = "placeOfPublication";
                                break;
                        case 14: expected = "licence";
                                break;
                        case 15: expected = "idOther";
                                break;
                        default: expected = "$.$";
                                System.err.println("  - ERROR: Incorrect headings - too many fields");
                                System.err.println("  - There is likely data in this column, with no heading");
                                System.exit(0);
                                break;
                    }
                    if (!expected.equals(field)) {
                        System.err.println("  - ERROR: Expect heading '" + expected + "' in heading position " + headings.size());
                        System.exit(0);
                    }        
                }
            } else {
                // Now check each field meets the requirements
                int position = 0;
                for (String value : record) {
                    // Set the organisation if required
                    if (org == null) {
                        org = value;
                        System.out.println(" - Setting organisation: " + org);
                    }
                    
                    switch(++position) {
                        case 1: //organisation
                            if (!org.equals(value)) {
                                System.err.println(" - ERROR on line " + lineCounter);
                                System.err.println("  - Organsiation ('" + value + "') should be '" + org + "'");
                                System.exit(0);
                            }
                            this.checkNonRepeatable(lineCounter, "organisation", value);
                            break;
                        case 2: // idLocal
                            this.checkMandatory(lineCounter, "idLocal", value);
                            this.checkNonRepeatable(lineCounter, "idLocal", value);
                            break;
                        case 3: // title
                            this.checkMandatory(lineCounter, "title", value);
                            this.checkNonRepeatable(lineCounter, "title", value);
                            break;
                        case 4: // urlMain
                            this.checkMandatory(lineCounter, "urlMain", value);
                            this.checkNonRepeatable(lineCounter, "urlMain", value);
                            break;
                        case 5: // year
                            this.checkNonRepeatable(lineCounter, "year", value);
                            break;
                        case 6: // publisher
                            break;
                        case 7: // creator
                            break;
                        case 8: // topic
                            break;
                        case 9: // description
                            break;
                        case 10: // urlPDF
                            this.checkNonRepeatable(lineCounter, "urlPDF", value);
                            break;
                        case 11: // urlOther
                            break;
                        case 12: // urlIIIF
                            this.checkNonRepeatable(lineCounter, "urlIIIF", value);
                            break;
                        case 13: // placeOfPublication
                            break;
                        case 14: // licence
                            this.checkNonRepeatable(lineCounter, "licence", value);
                            break;
                        case 15: // idOther
                            break;
                        default: // Something has gone wrong
                            System.err.println(" - ERROR on line " + lineCounter);
                            System.err.println("  - Unexpected value (" + value + ") - too many fields");
                            System.exit(0);
                            break;
                    }
                }
            }
            lineCounter++;
        }
        
        // Report success!
        System.out.println("\n - SUCCESS!");
        System.out.println("   - Processed " + lineCounter + " records\n");
    }
    
    private void checkMandatory(int lineCounter, String field, String value) {
        if (value.equals("")) {
            System.err.println(" - ERROR on line " + lineCounter);
            System.err.println("  - " + field + " cannot be empty, it is a MANDATORY field");
            System.exit(0);
        }
    }
    
    private void checkNonRepeatable(int lineCounter, String field, String value) {
        if (value.contains("|")) {
            System.err.println(" - ERROR on line " + lineCounter);
            System.err.println("  - " + field + " is not a repeatable field:");
            System.err.println("  - " + value);
            System.exit(0);
        }
    }
    
    public static void main(String[] args) {
        // Take the filename as the only parameter
        if (args.length < 1) {
            System.err.println("Please supply a filename to validate");
            System.exit(0);
        }
        
        try {
            Validator v = new Validator(args[0]);   
        } catch (Exception e) {
            System.err.println("Error encountered:");
            System.err.println(" - " + e.getMessage() + "\n");
            e.printStackTrace();
            System.exit(0);
        }
    }
}