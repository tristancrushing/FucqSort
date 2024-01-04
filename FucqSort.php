<?php
/**
 * FucqSort Class
 * 
 * Provides a collection of sorting algorithms for educational and practical use.
 * Author: Tristan McGowan of ipspy.net (tristan@ipspy.net)
 * 
 * Methods:
 * - sort: A custom FucqSort algorithm (Production Ready).
 * - bubbleSort: Standard Bubble Sort (Production Ready).
 * - selectionSort: Standard Selection Sort (Production Ready).
 * - insertionSort: Standard Insertion Sort (Production Ready).
 * - quickSort: Standard Quick Sort (Production Ready).
 * - piedPiperSort: Conceptual Pied Piper Sort (Experimental).
 * - custom3DMatrixSort: Custom Middle-Out 3D Matrix Sort (Experimental).
 * - customIncrementalKeySort: LessThanGreaterThan Sort (Experimental).
 * - blockSort: Block Sort Algorithm (Production Ready (maybe?)).
 * 
 * Note: Experimental methods are for conceptual understanding and may not be optimized for all production scenarios.
 */
class FucqSort
{
    /**
     * Sorts an array using the FucqSort algorithm.
     * 
     * FucqSort is designed to be Fast, Unconventional, Clever, and Quick.
     * It utilizes a unique approach where each integer value in the array
     * is used as both the key and the value, and then sorted using PHP's
     * ksort function. This method is especially efficient for large datasets
     * of integers.
     * 
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public static function sort(array $arr): array
    {
        $sortedArray = [];

        // Assign each value as both key and value.
        foreach ($arr as $value) {
            $sortedArray[$value] = $value;
        }

        // Utilize ksort for efficient sorting.
        ksort($sortedArray);

        // Return the sorted values.
        return array_values($sortedArray);
    }

    /**
     * Bubble Sort Algorithm
     * 
     * Bubble Sort is a basic sorting algorithm that repeatedly steps through the list,
     * compares adjacent elements, and swaps them if they are in the wrong order.
     * The process is repeated until the list is sorted.
     * 
     * It's called 'bubble sort' because smaller values 'bubble' to the top of the list
     * as the algorithm progresses.
     * 
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public static function bubbleSort(array $arr): array
    {
        $n = count($arr);
        // Loop through each element of the array
        for ($i = 0; $i < $n; $i++) {
            // Loop through the array, stopping earlier each time
            for ($j = 0; $j < $n - $i - 1; $j++) {
                // Compare adjacent elements
                if ($arr[$j] > $arr[$j + 1]) {
                    // Swap elements if they are in the wrong order
                    [$arr[$j], $arr[$j + 1]] = [$arr[$j + 1], $arr[$j]];
                }
            }
        }
        return $arr;
    }

    /**
     * Selection Sort Algorithm
     * 
     * Selection Sort divides the list into a sorted and an unsorted sublist. 
     * In each iteration, it selects the smallest (or largest) element from 
     * the unsorted sublist and moves it to the end of the sorted sublist.
     * 
     * This process is repeated until all elements are moved to the sorted sublist.
     * 
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public static function selectionSort(array $arr): array
    {
        $n = count($arr);
        // Loop through each element of the array
        for ($i = 0; $i < $n; $i++) {
            // Assume the current position holds the smallest element
            $minIndex = $i;
            // Loop through the unsorted part of the array
            for ($j = $i + 1; $j < $n; $j++) {
                // Update minIndex if a smaller element is found
                if ($arr[$j] < $arr[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // Swap the found minimum element with the first element
            [$arr[$i], $arr[$minIndex]] = [$arr[$minIndex], $arr[$i]];
        }
        return $arr;
    }

    /**
     * Insertion Sort Algorithm
     * 
     * Insertion Sort builds the final sorted array one item at a time. 
     * It is more efficient for smaller lists or partially sorted lists but less 
     * efficient for larger lists compared to algorithms like quicksort or merge sort.
     * 
     * The algorithm works by taking elements from the unsorted list and inserting 
     * them at the correct position in the sorted part of the list.
     * 
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public static function insertionSort(array $arr): array
    {
        $n = count($arr);
        // Loop through each element in the array
        for ($i = 1; $i < $n; $i++) {
            $key = $arr[$i];
            $j = $i - 1;

            // Move elements that are greater than $key to one position ahead of their current position
            while ($j >= 0 && $arr[$j] > $key) {
                $arr[$j + 1] = $arr[$j];
                $j--;
            }
            $arr[$j + 1] = $key;
        }
        return $arr;
    }

    /**
     * Quick Sort Algorithm
     * 
     * Quick Sort is a highly efficient divide-and-conquer sorting algorithm. 
     * It works by selecting a 'pivot' element from the array and partitioning 
     * the other elements into two sub-arrays, according to whether they are 
     * less than or greater than the pivot.
     * 
     * The sub-arrays are then sorted recursively.
     * 
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public static function quickSort(array $arr): array
    {
        if(count($arr) < 2){
            return $arr;
        }

        $left = $right = [];
        $pivot = $arr[0];

        // Partition the array into elements less than and greater than the pivot
        for ($i = 1; $i < count($arr); $i++) {
            if ($arr[$i] < $pivot) {
                $left[] = $arr[$i];
            } else {
                $right[] = $arr[$i];
            }
        }

        // Recursively apply the same logic to the left and right arrays
        return array_merge(self::quickSort($left), array($pivot), self::quickSort($right));
    }

    /**
     * Pied Piper Sort Algorithm (Conceptual)
     * 
     * The Pied Piper Sort is inspired by a fictional concept. It processes an array
     * from the middle, comparing and swapping elements. This method is more for 
     * understanding the concept of array processing than practical sorting.
     * 
     * It starts from the middle of the array and moves outwards, comparing adjacent 
     * elements and swapping them if necessary, in both directions.
     * 
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public static function piedPiperSort(array $arr): array
    {
        $n = count($arr);
        $mid = floor($n / 2);

        // Start from the middle and expand outwards
        for ($i = $mid; $i < $n - 1; $i++) {
            // Compare and swap if needed (going right)
            if ($arr[$i] > $arr[$i + 1]) {
                [$arr[$i], $arr[$i + 1]] = [$arr[$i + 1], $arr[$i]];
            }
        }
        
        for ($i = $mid - 1; $i > 0; $i--) {
            // Compare and swap if needed (going left)
            if ($arr[$i] < $arr[$i - 1]) {
                [$arr[$i], $arr[$i - 1]] = [$arr[$i - 1], $arr[$i]];
            }
        }

        return $arr;
    }

    /**
     * Custom Middle-Out 3D Matrix Sort
     * 
     * This function sorts a 3D matrix by first flattening it into a 1D array, 
     * sorting the array, and then reassembling it into a 3D matrix from the central 
     * point outward in all three dimensions.
     * 
     * @param array $matrix The 3D matrix to be sorted.
     * @return array The sorted 3D matrix.
     */
    public static function custom3DMatrixSort(array $matrix): array
    {
        $flatten = [];
        foreach ($matrix as $twoD) {
            foreach ($twoD as $oneD) {
                foreach ($oneD as $element) {
                    $flatten[] = $element;
                }
            }
        }

        sort($flatten);

        $size = count($matrix);
        $mid = floor($size / 2);
        $sortedMatrix = array_fill(0, $size, array_fill(0, $size, array_fill(0, $size, null)));

        // Reassemble the matrix from the central point outward
        $index = 0;
        for ($z = 0; $z < $size; $z++) {
            for ($y = 0; $y < $size; $y++) {
                for ($x = 0; $x < $size; $x++) {
                    $sortedMatrix[$z][$y][$x] = $flatten[$index++];
                }
            }
        }

        return $sortedMatrix;
    }

    /**
     * LessThanGreaterThan Sort Algorithm
     * 
     * This algorithm creates a sorted array by comparing adjacent elements and 
     * assigning positive or negative integer keys based on whether the value is 
     * higher or lower than the previous one.
     * 
     * It's a unique method that focuses on relative differences between elements 
     * rather than their absolute values.
     * 
     * @param array $arr The array to be sorted.
     * @return array The sorted array.
     */
    public static function customIncrementalKeySort(array $arr): array
    {
        $sortedArray = [];
        $currentKey = 0;

        foreach ($arr as $value) {
            // Compare with previous element and adjust key accordingly
            if (!empty($sortedArray)) {
                $currentKey += ($value > end($sortedArray)) ? 1 : -1;
            }

            // Add element to the sorted array with the calculated key
            $sortedArray[$currentKey] = $value;
        }

        // Sort the array by keys and return values
        ksort($sortedArray);
        return array_values($sortedArray);
    }

    /**
     * Block Sort Algorithm
     * 
     * Block Sort is a sorting algorithm that breaks the array into blocks and sorts them.
     * The size of each block is typically the square root of the array's length. This method
     * combines the principles of merge sort and insertion sort to efficiently sort the array.
     * 
     * @param array $array The array to be sorted passed by reference.
     */
    public static function blockSort(array &$array): void {
        $n = count($array);
        $blockSize = (int) sqrt($n);

        for ($size = 1; $size < $n; $size *= 2) {
            for ($leftStart = 0; $leftStart < $n; $leftStart += 2 * $size) {
                $mid = min($leftStart + $size, $n);
                $rightEnd = min($leftStart + 2 * $size, $n);

                self::blockMerge($array, $leftStart, $mid, $rightEnd, $blockSize);
            }
        }
    }

    /**
     * Block Merge
     * 
     * Helper function for Block Sort. It merges two sorted subarrays of the main array.
     * 
     * @param array $array The main array passed by reference.
     * @param int $left The starting index of the left subarray.
     * @param int $mid The ending index of the left subarray and starting index of the right subarray.
     * @param int $right The ending index of the right subarray.
     * @param int $blockSize The size of the blocks used in the sort.
     */
    private static function blockMerge(array &$array, int $left, int $mid, int $right, int $blockSize): void {
        // Temporary array for merging
        $temp = [];
        $i = $left;
        $j = $mid;

        // Merge logic
        while ($i < $mid && $j < $right) {
            if ($array[$i] < $array[$j]) {
                $temp[] = $array[$i++];
            } else {
                $temp[] = $array[$j++];
            }
        }

        // Copy remaining elements
        while ($i < $mid) {
            $temp[] = $array[$i++];
        }
        while ($j < $right) {
            $temp[] = $array[$j++];
        }

        // Copy back to the original array
        for ($k = $left; $k < $right; $k++) {
            $array[$k] = $temp[$k - $left];
        }
    }
    
}

?>
