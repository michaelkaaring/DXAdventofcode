defmodule Aoc16.Day06Test do
  use ExUnit.Case, async: true

  test "part 1 example code" do
    input =
      """
      eedadn
      drvtee
      eandsr
      raavrd
      atevrs
      tsrnev
      sdttsa
      rasrtv
      nssdts
      ntnada
      svetve
      tesnvt
      vntsnd
      vrdear
      dvrsen
      enarar
      """
      |> String.trim
      |> String.split("\n")

      {highest_word, _lowest_word} = Aoc16.Day06.process_lines(input)
      assert highest_word == "easter"
  end
end
